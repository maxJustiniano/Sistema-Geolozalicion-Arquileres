// Tipos de propiedad disponibles para autocompletado
const propertyTypes = [
    { value: '1', label: 'Casa' },
    { value: '2', label: 'Departamento' },
    { value: '3', label: 'Terreno' },
    { value: '4', label: 'PH' },
    { value: '5', label: 'Local Comercial' },
];

const stayTypes = [
    { value: '1', label: 'Apartamento' },
    { value: '2', label: 'Casa y Chalet' },
    { value: '3', label: 'Habitaciones Particulares' },
    { value: '4', label: 'Villa' },
    { value: '5', label: 'Alquiler' },
    { value: '6', label: 'Cabaña' },
    { value: '7', label: 'Albergue' },
    { value: '8', label: 'Hotel' },
    { value: '9', label: 'Residencial' },
    { value: '10', label: 'Camping' }
];

const MAX_IMAGES = 10;
// Usamos esto solo para controlar la UI (qué slots mostrar), no para enviar datos.
let selectedImages = []; 
let locationMap;
let locationMarker;

document.addEventListener('DOMContentLoaded', () => {
    const typeOfStaySelect = document.getElementById('typeOfStaySelect');
    const publishFormCard = document.getElementById('publishFormCard');
    const propertyForm = document.getElementById('propertyForm');
    const saveDraftBtn = document.getElementById('saveDraftBtn');
    const imageSlotsGrid = document.getElementById('imageSlotsGrid');
    const propertyTypeSelect = document.getElementById('propertyTypeSelect');
    const priceInput = document.getElementById('priceInput');
    const pricePeriod = document.getElementById('pricePeriod');
    const toggleServicesBtn = document.getElementById('toggleServicesBtn');
    const servicesCheckboxes = document.getElementById('servicesCheckboxes');


    function populateTypeOfStaySelect() {
        if (!typeOfStaySelect) return;
        
        // Agregar las opciones dinámicamente
        stayTypes.forEach(type => {
            const option = document.createElement('option');
            option.value = type.value; // El value debe ser el ID (1, 2, 3...)
            option.textContent = type.label;
            typeOfStaySelect.appendChild(option);           
        });       
    }
    

    // Llama a la nueva función al cargar
    populateTypeOfStaySelect();
    
    // Inicializar slots de imágenes
    initImageSlots();

    // Inicializar mapa de ubicación
    initLocationMap();

    // Poblar select de tipo de propiedad
    if (propertyTypeSelect) {
        propertyTypes.forEach(pt => {
            const option = document.createElement('option');
            option.value = pt.value;
            option.textContent = pt.label;
            propertyTypeSelect.appendChild(option);
        });
    }

    // Formatear precio con separadores de miles (Visual)
    if (priceInput) {
        priceInput.addEventListener('input', (e) => {
            const input = e.target;
            const cursorPosition = input.selectionStart;
            let value = input.value.replace(/\./g, ''); // Eliminar puntos
            value = value.replace(/[^\d]/g, ''); // Solo números
            
            if (value) {
                const formatted = parseInt(value, 10).toLocaleString('es-AR');
                input.value = formatted;
                
                // Restaurar cursor
                const newLength = formatted.length;
                const oldLength = value.length; // aprox
                // Ajuste simple del cursor para mantener usabilidad
                if (cursorPosition) {
                     // Lógica simplificada para mantener foco
                }
            } else {
                input.value = '';
            }
        });

        priceInput.addEventListener('paste', (e) => {
            e.preventDefault();
            const paste = (e.clipboardData || window.clipboardData).getData('text');
            const numbers = paste.replace(/[^\d]/g, '');
            if (numbers) {
                const formatted = parseInt(numbers, 10).toLocaleString('es-AR');
                priceInput.value = formatted;
            }
        });
    }

    // Toggle de servicios
    if (toggleServicesBtn) {
        toggleServicesBtn.addEventListener('click', () => {
            const isVisible = servicesCheckboxes.style.display !== 'none';
            servicesCheckboxes.style.display = isVisible ? 'none' : 'block';
            toggleServicesBtn.innerHTML = isVisible 
                ? '<i class="fas fa-list"></i> Seleccionar de lista'
                : '<i class="fas fa-times"></i> Ocultar lista';
        });
    }

    // ==========================================
    // LÓGICA DE IMÁGENES (Adaptada para Submit Nativo)
    // ==========================================
    
    function initImageSlots() {
        imageSlotsGrid.innerHTML = '';
        createImageSlot(0, true);
        createImageSlot(1, false);
    }

    function createImageSlot(slotIndex, isFirst) {
        const slot = document.createElement('div');
        slot.className = 'image-slot';
        slot.dataset.slotIndex = slotIndex;
        
        // NOTA: Se agrega name="images[]" para que Laravel lo reciba
        if (isFirst) {
            slot.classList.add('portada-slot');
            slot.innerHTML = `
                <label class="slot-label">
                    <input type="file" name="images[]" accept="image/*" class="slot-input" data-slot="${slotIndex}">
                    <div class="slot-content">
                        <i class="fas fa-image"></i>
                        <span>Portada</span>
                    </div>
                </label>
                <button type="button" class="slot-remove" style="display: none;"><i class="fas fa-times"></i></button>
            `;
        } else {
            slot.innerHTML = `
                <label class="slot-label" style="display: none;">
                    <input type="file" name="images[]" accept="image/*" class="slot-input" data-slot="${slotIndex}">
                </label>
                <button type="button" class="slot-add">
                    <i class="fas fa-plus"></i>
                </button>
                <button type="button" class="slot-remove" style="display: none;"><i class="fas fa-times"></i></button>
            `;
        }
        
        imageSlotsGrid.appendChild(slot);
        
        const slotInput = slot.querySelector('.slot-input');
        const slotAdd = slot.querySelector('.slot-add');
        const slotRemove = slot.querySelector('.slot-remove');
        const slotLabel = slot.querySelector('.slot-label');
        
        if (slotInput) {
            slotInput.addEventListener('change', (e) => {
                handleSlotImageUpload(slotIndex, e.target.files[0]);
            });
        }
        
        if (slotLabel && isFirst) {
            slotLabel.addEventListener('click', (e) => {
                if (e.target.tagName !== 'INPUT') {
                    slotInput.click();
                }
            });
        }
        
        if (slotAdd) {
            slotAdd.addEventListener('click', () => {
                slotInput.click();
            });
        }
        
        if (slotRemove) {
            slotRemove.addEventListener('click', () => {
                removeSlotImage(slotIndex);
            });
        }
        
        return slot;
    }

    function handleSlotImageUpload(slotIndex, file) {
        if (!file || !file.type.startsWith('image/')) return;
        
        // Solo usamos FileReader para mostrar la previsualización al usuario.
        // El archivo real ya está en el input y se enviará al hacer submit.
        const reader = new FileReader();
        reader.onload = (e) => {
            const imageData = {
                // Guardamos metadatos solo para lógica visual
                slotIndex: slotIndex,
                preview: e.target.result 
            };
            
            // Actualizar estado visual
            const existingIndex = selectedImages.findIndex(img => img.slotIndex === slotIndex);
            if (existingIndex >= 0) {
                selectedImages[existingIndex] = imageData;
            } else {
                selectedImages.push(imageData);
            }
            
            renderSlotImage(slotIndex, imageData.preview);
            showNextSlot();
        };
        reader.readAsDataURL(file);
    }

    function renderSlotImage(slotIndex, previewUrl) {
        const slot = imageSlotsGrid.querySelector(`[data-slot-index="${slotIndex}"]`);
        if (!slot) return;
        
        const slotLabel = slot.querySelector('.slot-label');
        const slotAdd = slot.querySelector('.slot-add');
        const slotRemove = slot.querySelector('.slot-remove');
        let slotContent = slot.querySelector('.slot-content');
        
        if (slotLabel) slotLabel.style.display = 'none';
        if (slotAdd) slotAdd.style.display = 'none';
        if (slotRemove) slotRemove.style.display = 'flex';
        
        if (slotContent) {
            slotContent.innerHTML = `<img src="${previewUrl}" alt="Imagen">`;
        } else {
            slotContent = document.createElement('div');
            slotContent.className = 'slot-content';
            slotContent.innerHTML = `<img src="${previewUrl}" alt="Imagen">`;
            if (slotRemove) {
                slot.insertBefore(slotContent, slotRemove);
            } else {
                slot.appendChild(slotContent);
            }
        }
    }

    function removeSlotImage(slotIndex) {
        // 1. Eliminar del array visual
        selectedImages = selectedImages.filter(img => img.slotIndex !== slotIndex);
        
        // 2. Limpiar el input file real (IMPORTANTE para que no se envíe)
        const slot = imageSlotsGrid.querySelector(`[data-slot-index="${slotIndex}"]`);
        if (!slot) return;
        
        const slotInput = slot.querySelector('.slot-input');
        if (slotInput) slotInput.value = ''; // Esto vacía el archivo seleccionado

        // 3. Resetear UI
        const slotLabel = slot.querySelector('.slot-label');
        const slotAdd = slot.querySelector('.slot-add');
        const slotRemove = slot.querySelector('.slot-remove');
        const slotContent = slot.querySelector('.slot-content');
        
        if (slotContent) slotContent.remove();
        
        if (slotIndex === 0) {
            if (slotLabel) slotLabel.style.display = 'flex';
            if (slotRemove) slotRemove.style.display = 'none';
            // Restaurar contenido original del label portada
            const iconContent = slotLabel.querySelector('.slot-content');
            if (!iconContent) {
                slotLabel.innerHTML = `
                    <input type="file" name="images[]" accept="image/*" class="slot-input" data-slot="${slotIndex}">
                    <div class="slot-content">
                        <i class="fas fa-image"></i>
                        <span>Portada</span>
                    </div>
                `;
                // Reasignar listener al nuevo input creado
                const newInput = slotLabel.querySelector('.slot-input');
                newInput.addEventListener('change', (e) => handleSlotImageUpload(slotIndex, e.target.files[0]));
            }
        } else {
            const hasMoreImages = selectedImages.some(img => img.slotIndex > slotIndex);
            if (hasMoreImages) {
                if (slotAdd) slotAdd.style.display = 'flex';
            } else {
                slot.style.display = 'none';
            }
            if (slotRemove) slotRemove.style.display = 'none';
        }
        
        hideEmptySlots();
    }

    function showNextSlot() {
        let lastImageIndex = -1;
        selectedImages.forEach(img => {
            if (img.slotIndex > lastImageIndex) lastImageIndex = img.slotIndex;
        });
        
        const nextSlotIndex = lastImageIndex + 1;
        if (nextSlotIndex < MAX_IMAGES) {
            let slot = imageSlotsGrid.querySelector(`[data-slot-index="${nextSlotIndex}"]`);
            if (!slot) {
                slot = createImageSlot(nextSlotIndex, false);
            }
            const slotAdd = slot.querySelector('.slot-add');
            if (slotAdd) slotAdd.style.display = 'flex';
            slot.style.display = ''; // Asegurar que sea visible
        }
    }

    function hideEmptySlots() {
        let lastImageIndex = -1;
        selectedImages.forEach(img => {
            if (img.slotIndex > lastImageIndex) lastImageIndex = img.slotIndex;
        });
        
        const slotsToHide = lastImageIndex + 2;
        const allSlots = imageSlotsGrid.querySelectorAll('.image-slot');
        
        allSlots.forEach(slot => {
            const slotIndex = parseInt(slot.dataset.slotIndex);
            const hasImage = selectedImages.some(img => img.slotIndex === slotIndex);
            
            if (!hasImage && slotIndex >= slotsToHide) {
                slot.style.display = 'none';
            } else if (slotIndex < slotsToHide) {
                slot.style.display = '';
            }
        });
    }

    // ==========================================
    // LÓGICA DEL MAPA
    // ==========================================
    function initLocationMap() {
        if (!document.getElementById('locationMap')) return;

        const formosaBounds = L.latLngBounds(
            L.latLng(-26.25, -58.25),
            L.latLng(-26.10, -58.05)
        );
        const argenmap = L.tileLayer('https://wms.ign.gob.ar/geoserver/gwc/service/tms/1.0.0/capabaseargenmap@EPSG%3A3857@png/{z}/{x}/{-y}.png', {
            minZoom: 10, maxZoom: 18,
            attribution: '© IGN Argentina'
        });
        locationMap = L.map('locationMap', {
            center: L.latLng(-26.1773, -58.1810),
            zoom: 13,
            minZoom: 11, maxZoom: 18,
            zoomControl: true,
            layers: [argenmap],
            maxBounds: formosaBounds,
            maxBoundsViscosity: 1.0
        });
        locationMap.fitBounds(formosaBounds, { padding: [20, 20] });

        const updateCoordinates = (lat, lng) => {
            document.getElementById('displayLat').textContent = lat.toFixed(6);
            document.getElementById('displayLng').textContent = lng.toFixed(6);
            document.getElementById('hiddenLat').value = lat;
            document.getElementById('hiddenLng').value = lng;
        };

        let skipNextClick = false;
        locationMap.on('dragstart', () => { skipNextClick = true; });

        locationMap.on('click', (e) => {
            if (skipNextClick) { skipNextClick = false; return; }
            const { lat, lng } = e.latlng;
            if (locationMarker) {
                locationMap.removeLayer(locationMarker);
            }
            locationMarker = L.marker([lat, lng], { draggable: true }).addTo(locationMap);
            updateCoordinates(lat, lng);
            locationMarker.on('dragend', (evt) => {
                const pos = evt.target.getLatLng();
                updateCoordinates(pos.lat, pos.lng);
            });
        });

        
        const centerBtn = document.getElementById('centerMapBtn');
        if (centerBtn) {
            centerBtn.addEventListener('click', () => {
                locationMap.setView([-26.1773, -58.1810], 13);
            });
        }
    }

    // ==========================================
    // ENVÍO DEL FORMULARIO (Nativo)
    // ==========================================
    propertyForm.addEventListener('submit', (event) => {
        
        // 1. Validar ubicación (si falla, impedimos el envío)
        if (!document.getElementById('hiddenLat').value || !document.getElementById('hiddenLng').value) {
            event.preventDefault(); // Detenemos el envío
            alert('Por favor, selecciona la ubicación en el mapa haciendo clic.');
            return;
        }

        // 2. Limpiar precio para envío (Quitar puntos del valor del input)
        // Esto modifica el valor del input justo antes de enviar para que sea un número válido
        const currentPrice = priceInput.value;
        priceInput.value = currentPrice.replace(/\./g, '');

        // A partir de aquí, el navegador toma el control y envía el formulario al Controller de Laravel
    });

    // Guardar borrador (Funcionalidad opcional frontend)
    if (saveDraftBtn) {
        saveDraftBtn.addEventListener('click', () => {
            alert('Funcionalidad de borrador pendiente de conectar con backend.');
        });
    }
});