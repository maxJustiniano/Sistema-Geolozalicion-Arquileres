// Tipos de propiedad disponibles para autocompletado
const propertyTypes = [
    { value: 'apartamento', label: 'Departamento' },
    { value: 'casa_chalet', label: 'Casa / Chalet' },
    { value: 'habitacion_particular', label: 'Habitación Particular' },
    { value: 'alquiler', label: 'Terreno / Alquiler' },
    { value: 'villa', label: 'Villa' },
    { value: 'cabana', label: 'Cabaña' },
    { value: 'albergue', label: 'Albergue' },
    { value: 'hotel', label: 'Hotel' },
    { value: 'residencial', label: 'Residencial' },
    { value: 'camping', label: 'Camping' }
];

const MAX_IMAGES = 10;
let selectedImages = []; 
let locationMap;
let locationMarker;

document.addEventListener('DOMContentLoaded', () => {
    const publishFormCard = document.getElementById('publishFormCard');
    const propertyForm = document.getElementById('propertyForm');
    const saveDraftBtn = document.getElementById('saveDraftBtn');
    const imageSlotsGrid = document.getElementById('imageSlotsGrid');
    const propertyTypeSelect = document.getElementById('propertyTypeSelect');
    const priceInput = document.getElementById('priceInput');
    const pricePeriod = document.getElementById('pricePeriod');
    const toggleServicesBtn = document.getElementById('toggleServicesBtn');
    const servicesCheckboxes = document.getElementById('servicesCheckboxes');

    // Inicializar slots de imágenes
    initImageSlots();

    // Inicializar mapa de ubicación
    initLocationMap();

    // Poblar select de tipo de propiedad
    propertyTypes.forEach(pt => {
        const option = document.createElement('option');
        option.value = pt.value;
        option.textContent = pt.label;
        propertyTypeSelect.appendChild(option);
    });

    // Formatear precio con separadores de miles
    priceInput.addEventListener('input', (e) => {
        const input = e.target;
        const cursorPosition = input.selectionStart;
        let value = input.value.replace(/\./g, ''); // Eliminar puntos existentes
        value = value.replace(/[^\d]/g, ''); // Solo números
        
        if (value) {
            // Formatear con separadores de miles
            const formatted = parseInt(value, 10).toLocaleString('es-AR');
            input.value = formatted;
            
            // Restaurar posición del cursor 
            const newLength = formatted.length;
            const oldLength = value.length;
            const diff = newLength - oldLength;
            const newPosition = Math.min(cursorPosition + diff, newLength);
            input.setSelectionRange(newPosition, newPosition);
        } else {
            input.value = '';
        }
    });

    // Permitir solo números al pegar
    priceInput.addEventListener('paste', (e) => {
        e.preventDefault();
        const paste = (e.clipboardData || window.clipboardData).getData('text');
        const numbers = paste.replace(/[^\d]/g, '');
        if (numbers) {
            const formatted = parseInt(numbers, 10).toLocaleString('es-AR');
            priceInput.value = formatted;
        }
    });

    // Toggle servicios checkboxes
    toggleServicesBtn.addEventListener('click', () => {
        const isVisible = servicesCheckboxes.style.display !== 'none';
        servicesCheckboxes.style.display = isVisible ? 'none' : 'block';
        toggleServicesBtn.innerHTML = isVisible 
            ? '<i class="fas fa-list"></i> Seleccionar de lista'
            : '<i class="fas fa-times"></i> Ocultar lista';
    });

    // Inicializar slots de imágenes
    function initImageSlots() {
        imageSlotsGrid.innerHTML = '';
        
        // Crear solo el primer slot 
        createImageSlot(0, true);
        
        // Crear solo el segundo slot inicialmente, los demás se crearán dinámicamente
        createImageSlot(1, false);
        
        // No crear los demás slots todavía, se crearán cuando se necesiten
    }

    function createImageSlot(slotIndex, isFirst) {
        const slot = document.createElement('div');
        slot.className = 'image-slot';
        slot.dataset.slotIndex = slotIndex;
        
        if (isFirst) {
            slot.classList.add('portada-slot');
            slot.innerHTML = `
                <label class="slot-label">
                    <input type="file" accept="image/*" class="slot-input" data-slot="${slotIndex}">
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
                    <input type="file" accept="image/*" class="slot-input" data-slot="${slotIndex}">
                </label>
                <button type="button" class="slot-add">
                    <i class="fas fa-plus"></i>
                </button>
                <button type="button" class="slot-remove" style="display: none;"><i class="fas fa-times"></i></button>
            `;
        }
        
        imageSlotsGrid.appendChild(slot);
        
        // Event listeners
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
            // Para el slot de portada, hacer clic en el label abre el selector
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
        
        const reader = new FileReader();
        reader.onload = (e) => {
            const imageData = {
                file: file,
                preview: e.target.result,
                slotIndex: slotIndex
            };
            
            // Si ya existe una imagen en este slot, reemplazarla
            const existingIndex = selectedImages.findIndex(img => img.slotIndex === slotIndex);
            if (existingIndex >= 0) {
                selectedImages[existingIndex] = imageData;
            } else {
                selectedImages.push(imageData);
            }
            
            renderSlotImage(slotIndex, imageData);
            
            // Mostrar el siguiente slot si hay espacio
            showNextSlot();
        };
        reader.readAsDataURL(file);
    }

    function renderSlotImage(slotIndex, imageData) {
        const slot = imageSlotsGrid.querySelector(`[data-slot-index="${slotIndex}"]`);
        if (!slot) return;
        
        const slotLabel = slot.querySelector('.slot-label');
        const slotAdd = slot.querySelector('.slot-add');
        const slotRemove = slot.querySelector('.slot-remove');
        let slotContent = slot.querySelector('.slot-content');
        
        // Ocultar input y botón +
        if (slotLabel) slotLabel.style.display = 'none';
        if (slotAdd) slotAdd.style.display = 'none';
        if (slotRemove) slotRemove.style.display = 'flex';
        
        // Mostrar imagen
        if (slotContent) {
            slotContent.innerHTML = `<img src="${imageData.preview}" alt="Imagen ${slotIndex + 1}">`;
        } else {
            // Si no hay slot-content, crear uno
            slotContent = document.createElement('div');
            slotContent.className = 'slot-content';
            slotContent.innerHTML = `<img src="${imageData.preview}" alt="Imagen ${slotIndex + 1}">`;
            if (slotRemove) {
                slot.insertBefore(slotContent, slotRemove);
            } else {
                slot.appendChild(slotContent);
            }
        }
    }

    function removeSlotImage(slotIndex) {
        // Eliminar de selectedImages
        selectedImages = selectedImages.filter(img => img.slotIndex !== slotIndex);
        
        // Resetear el slot
        const slot = imageSlotsGrid.querySelector(`[data-slot-index="${slotIndex}"]`);
        if (!slot) return;
        
        const slotLabel = slot.querySelector('.slot-label');
        const slotAdd = slot.querySelector('.slot-add');
        const slotRemove = slot.querySelector('.slot-remove');
        const slotContent = slot.querySelector('.slot-content');
        const slotInput = slot.querySelector('.slot-input');
        
        if (slotInput) slotInput.value = '';
        if (slotContent) slotContent.remove();
        
        if (slotIndex === 0) {
            // Es el slot de portada, mostrar el label
            if (slotLabel) slotLabel.style.display = 'flex';
            if (slotRemove) slotRemove.style.display = 'none';
        } else {
            // Es un slot adicional
            // Si hay más imágenes después de este slot, solo mostrar el botón +
            // Si no hay más imágenes, ocultar completamente el slot
            const hasMoreImages = selectedImages.some(img => img.slotIndex > slotIndex);
            if (hasMoreImages) {
                if (slotAdd) slotAdd.style.display = 'flex';
            } else {
                // Ocultar completamente el slot si no hay más imágenes después
                slot.style.display = 'none';
            }
            if (slotRemove) slotRemove.style.display = 'none';
        }
        
        // Ocultar slots innecesarios
        hideEmptySlots();
    }

    function showNextSlot() {
        // Encontrar el último slot con imagen
        let lastImageIndex = -1;
        selectedImages.forEach(img => {
            if (img.slotIndex > lastImageIndex) {
                lastImageIndex = img.slotIndex;
            }
        });
        
        // Crear y mostrar el siguiente slot disponible
        const nextSlotIndex = lastImageIndex + 1;
        if (nextSlotIndex < MAX_IMAGES) {
            let slot = imageSlotsGrid.querySelector(`[data-slot-index="${nextSlotIndex}"]`);
            
            // Si el slot no existe, crearlo
            if (!slot) {
                slot = createImageSlot(nextSlotIndex, false);
            }
            
            // Mostrar el botón +
            const slotAdd = slot.querySelector('.slot-add');
            if (slotAdd) {
                slotAdd.style.display = 'flex';
            }
        }
    }

    function hideEmptySlots() {
        // Encontrar el último slot con imagen
        let lastImageIndex = -1;
        selectedImages.forEach(img => {
            if (img.slotIndex > lastImageIndex) {
                lastImageIndex = img.slotIndex;
            }
        });
        
        // Ocultar completamente los slots vacíos después del último con imagen + 1
        // (el +1 es para mantener visible el siguiente slot con el botón +)
        const slotsToHide = lastImageIndex + 2;
        const allSlots = imageSlotsGrid.querySelectorAll('.image-slot');
        
        allSlots.forEach(slot => {
            const slotIndex = parseInt(slot.dataset.slotIndex);
            const hasImage = selectedImages.some(img => img.slotIndex === slotIndex);
            
            // Si el slot no tiene imagen y está después del último con imagen + 1, ocultarlo completamente
            if (!hasImage && slotIndex >= slotsToHide) {
                slot.style.display = 'none';
            } else if (slotIndex < slotsToHide) {
                slot.style.display = '';
            }
        });
    }

    // Inicializar mapa de ubicación
    function initLocationMap() {
        // Coordenadas por defecto: Formosa, Argentina
        locationMap = L.map('locationMap', {
            doubleClickZoom: true, // Permitir zoom con doble click
            zoomControl: true,
            scrollWheelZoom: true,
            boxZoom: false,
            keyboard: false,
            dragging: true,
            touchZoom: true
        }).setView([-26.1773, -58.1810], 13);
        
        L.tileLayer('https://wms.ign.gob.ar/geoserver/gwc/service/tms/1.0.0/capabaseargenmap@EPSG%3A3857@png/{z}/{x}/{-y}.png', {
            minZoom: 10,
            maxZoom: 18,
            attribution: '© IGN Argentina'
        }).addTo(locationMap);

        const updateCoordinates = (lat, lng) => {
            document.getElementById('displayLat').textContent = lat.toFixed(6);
            document.getElementById('displayLng').textContent = lng.toFixed(6);
            document.getElementById('hiddenLat').value = lat;
            document.getElementById('hiddenLng').value = lng;
        };

        // Interceptar eventos directamente en el contenedor del mapa
        const mapContainer = locationMap.getContainer();
        let clickTimer = null;
        let lastClickTime = 0;
        const DOUBLE_CLICK_DELAY = 300;
        let isDragging = false;
        let dragStartPos = null;
        let mouseDownTime = 0;
        let mouseDownPos = null;
        
        // Interceptar mousedown para detectar arrastre
        mapContainer.addEventListener('mousedown', (e) => {
            if (e.button === 0) { // Solo botón izquierdo
                isDragging = false;
                dragStartPos = { x: e.clientX, y: e.clientY };
                mouseDownPos = { x: e.clientX, y: e.clientY };
                mouseDownTime = Date.now();
            }
        }, true);
        
        mapContainer.addEventListener('mousemove', (e) => {
            if (dragStartPos && mouseDownPos) {
                const dx = Math.abs(e.clientX - dragStartPos.x);
                const dy = Math.abs(e.clientY - dragStartPos.y);
                // Si el mouse se movió más de 5 píxeles, es un arrastre
                if (dx > 5 || dy > 5) {
                    isDragging = true;
                }
            }
        }, true);
        
        // Interceptar mouseup para resetear el estado de arrastre
        mapContainer.addEventListener('mouseup', (e) => {
            if (e.button === 0) { // Solo botón izquierdo
                // Si estaba arrastrando, resetear todo y no procesar el click
                if (isDragging) {
                    isDragging = false;
                    dragStartPos = null;
                    mouseDownPos = null;
                    mouseDownTime = 0;
                    if (clickTimer) {
                        clearTimeout(clickTimer);
                        clickTimer = null;
                    }
                }
            }
        }, true);
        
        // Interceptar click en fase de captura para prevenir zoom
        mapContainer.addEventListener('click', (e) => {
            // Solo procesar clicks del botón izquierdo
            if (e.button !== 0 && e.button !== undefined) {
                return;
            }
            
            // Si el usuario estaba arrastrando, no hacer nada
            if (isDragging) {
                isDragging = false;
                dragStartPos = null;
                mouseDownPos = null;
                mouseDownTime = 0;
                return;
            }
            
            // Verificar si el click fue muy rápido después de mousedown (posible arrastre)
            const timeSinceMouseDown = Date.now() - mouseDownTime;
            if (timeSinceMouseDown < 50 && mouseDownPos) {
                const dx = Math.abs(e.clientX - mouseDownPos.x);
                const dy = Math.abs(e.clientY - mouseDownPos.y);
                if (dx > 5 || dy > 5) {
                    // Fue un arrastre, no procesar
                    return;
                }
            }
            
            const currentTime = Date.now();
            const timeSinceLastClick = currentTime - lastClickTime;
            lastClickTime = currentTime;
            
            // Si fue un doble click (menos de 300ms desde el último click), permitir zoom
            if (timeSinceLastClick < DOUBLE_CLICK_DELAY) {
                if (clickTimer) {
                    clearTimeout(clickTimer);
                    clickTimer = null;
                }
                // No prevenir el evento, dejar que Leaflet maneje el doble click para zoom
                return;
            }
            
            // Prevenir completamente el zoom en click simple
            e.preventDefault();
            e.stopPropagation();
            e.stopImmediatePropagation();
            
            // Convertir coordenadas del mouse a lat/lng
            const containerPoint = locationMap.mouseEventToContainerPoint(e);
            const latlng = locationMap.containerPointToLatLng(containerPoint);
            
            // Esperar para confirmar que es un click simple
            if (clickTimer) {
                clearTimeout(clickTimer);
            }
            
            clickTimer = setTimeout(() => {
                const { lat, lng } = latlng;
                
                if (locationMarker) {
                    locationMap.removeLayer(locationMarker);
                }
                
                locationMarker = L.marker([lat, lng], {
                    draggable: true,
                    icon: L.icon({
                        iconUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.4.0/images/marker-icon.png',
                        iconSize: [25, 41],
                        iconAnchor: [12, 41],
                        popupAnchor: [1, -34]
                    })
                }).addTo(locationMap);

                updateCoordinates(lat, lng);

                locationMarker.on('dragend', (e) => {
                    const pos = e.target.getLatLng();
                    updateCoordinates(pos.lat, pos.lng);
                });
                
                clickTimer = null;
            }, DOUBLE_CLICK_DELAY);
            
            return false;
        }, true); // Usar fase de captura (true) para interceptar antes que Leaflet

        // Botón para centrar el mapa
        document.getElementById('centerMapBtn').addEventListener('click', () => {
            locationMap.setView([-26.1773, -58.1810], 13);
        });
    }

    propertyForm.addEventListener('submit', (event) => {
        event.preventDefault();

        const formData = new FormData(propertyForm);
        
        // Convertir precio formateado a número sin formato
        const priceValue = priceInput.value.replace(/\./g, '');
        formData.set('price', priceValue);
        
        // Agregar imágenes en orden de slot
        selectedImages.sort((a, b) => a.slotIndex - b.slotIndex);
        selectedImages.forEach((imageData, index) => {
            formData.append(`images[${index}]`, imageData.file);
        });

        // Agregar servicios seleccionados
        const selectedServices = {
            facility: Array.from(document.querySelectorAll('input[name="facility"]:checked')).map(cb => cb.value),
            roomService: Array.from(document.querySelectorAll('input[name="roomService"]:checked')).map(cb => cb.value),
            groupType: Array.from(document.querySelectorAll('input[name="groupType"]:checked')).map(cb => cb.value),
            funType: Array.from(document.querySelectorAll('input[name="funType"]:checked')).map(cb => cb.value)
        };
        
        formData.append('selectedServices', JSON.stringify(selectedServices));

        // Validar ubicación
        if (!document.getElementById('hiddenLat').value || !document.getElementById('hiddenLng').value) {
            alert('Por favor, selecciona la ubicación en el mapa haciendo clic.');
            return;
        }

        console.log('Payload listo para enviar al backend:', Object.fromEntries(formData.entries()));
        alert('Publicación enviada (simulación). Integra con backend usando fetch/axios.');
        propertyForm.reset();
        priceInput.value = ''; // Limpiar el campo de precio formateado
        selectedImages = [];
        initImageSlots();
        if (locationMarker) {
            locationMap.removeLayer(locationMarker);
            locationMarker = null;
        }
        document.getElementById('displayLat').textContent = '-';
        document.getElementById('displayLng').textContent = '-';
    });

    saveDraftBtn.addEventListener('click', () => {
        const formData = new FormData(propertyForm);
        // Convertir precio formateado a número sin formato para el borrador
        const priceValue = priceInput.value.replace(/\./g, '');
        formData.set('price', priceValue);
        
        const draftData = {
            form: Object.fromEntries(formData.entries()),
            images: selectedImages.map(img => ({ slotIndex: img.slotIndex, name: img.file.name })),
            location: {
                lat: document.getElementById('hiddenLat').value,
                lng: document.getElementById('hiddenLng').value
            }
        };
        
        localStorage.setItem('propertyDraft', JSON.stringify(draftData));
        alert('Borrador guardado localmente (simulación).');
    });
});

