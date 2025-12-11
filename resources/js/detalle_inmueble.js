// Variables globales para almacenar los datos dinámicos
let currentProperty = null;
let propertyImages = [];
let currentImageIndex = 0;

// ==========================================
// FUNCIONES DE UTILIDAD
// ==========================================

/**
 * Formatea un número como moneda ARS.
 * @param {number} num - Precio.
 * @returns {string} Precio formateado.
 */
function formatPrice(num) {
    const formatter = new Intl.NumberFormat('es-AR', {
        style: 'decimal',
        currency: 'ARS',
        minimumFractionDigits: 0,
        maximumFractionDigits: 0,
    });
    return formatter.format(num);
}

/**
 * Mapea el slug del filtro a un nombre legible. 
 * (Asumimos que esta función existe o tienes un mapeo en tu JS/Blade)
 */
function getSpanishName(slug) {
    // Ejemplo de mapeo (debes completar con todos tus slugs)
    const namesMap = {
        'casa': 'Casa',
        'departamento': 'Departamento',
        'casa_chalet': 'Casa / Chalet',
        'alquiler': 'Alquiler',
        'estacionamiento': 'Estacionamiento',
        'wifi_gratis': 'WiFi Gratis',
        'bano_privado': 'Baño Privado',
        'cocina': 'Cocina',
        'admite_mascotas': 'Admite Mascotas',
        'piscina': 'Piscina',
        // Añadir todos los slugs de tu FiltroSeeder
    };
    return namesMap[slug] || slug.replace(/_/g, ' ').replace(/\b\w/g, c => c.toUpperCase());
}

/**
 * Renderiza la lista de servicios/filtros.
 * @param {string[]} services - Array de slugs (ej: ['wifi_gratis']).
 * @param {string} elementId - ID del contenedor (ej: 'facilitiesList').
 */
function renderServices(services, elementId) {
    const container = document.getElementById(elementId);
    if (!container || !services || services.length === 0) {
        // Ocultar la sección si no hay servicios para esa categoría
        const section = container ? container.closest('.service-category') : null;
        if (section) section.classList.add('hidden');
        return;
    }
    
    // Asegurarse de que la sección esté visible
    const section = container.closest('.service-category');
    if (section) section.classList.remove('hidden');

    container.innerHTML = services.map(slug => `
        <div class="service-item">
            <i class="fas fa-check-circle"></i> ${getSpanishName(slug)}
        </div>
    `).join('');
}


// ==========================================
// LÓGICA DE DATOS: FETCH Y BÚSQUEDA
// ==========================================

/**
 * Carga la lista completa de propiedades desde el API y busca la propiedad actual.
 * @param {number} id - ID de la propiedad a buscar.
 */
async function loadPropertyDetails(id) {
    if (!id) {
        document.querySelector('.detail-container').innerHTML = 
            '<h2>Error</h2><p>El ID de la propiedad no fue inyectado correctamente desde el servidor.</p>';
        return;
    }

    try {
        // 1. Fetch al endpoint del mapa que devuelve todas las propiedades
        const response = await fetch('/propiedades-mapa'); 

        if (!response.ok) {
            throw new Error(`Error HTTP: ${response.status}`);
        }
        
        const json = await response.json(); 
        const allProperties = json.data || []; // Array de propiedades
        
        // 2. BUSCAR la propiedad específica por ID
        const prop = allProperties.find(p => p.id == id); 

        if (!prop) {
            console.error(`Propiedad con ID ${id} no encontrada.`);
            document.querySelector('.detail-container').innerHTML = 
                '<h2>Propiedad No Encontrada</h2><p>El inmueble solicitado no está disponible.</p>';
            return;
        }
        
        // 3. Almacenar y procesar los datos
        currentProperty = prop;
        
        // El PropiedadMapResource solo devuelve 'imageUrl', por lo que solo tenemos una imagen.
        // Si quieres más, debes modificar el Resource para incluir 'allImages'.
        // 3. Almacenar y procesar los datos
        currentProperty = prop;
        
        // **********************************************
        // 🚨 CAMBIO CLAVE AQUÍ: Usar el array completo
        // **********************************************
        propertyImages = prop.allImages || []; // Usar el array 'allImages' del JSON
        
        // Si por alguna razón allImages está vacío, pero imageUrl existe, úsala como fallback
        if (propertyImages.length === 0 && prop.imageUrl) {
            propertyImages = [prop.imageUrl];
        }
        
        // 4. Inicializar la interfaz con los datos cargados
        initPropertyDetail(currentProperty);
        

    } catch (error) {
        console.error("Fallo al cargar los detalles de la propiedad:", error);
        document.querySelector('.detail-container').innerHTML = 
            `<h2>Error de Conexión</h2><p>Hubo un problema al cargar la información: ${error.message}</p>`;
    }
}


// ==========================================
// LÓGICA DE INICIALIZACIÓN DE UI
// ==========================================

function initPropertyDetail(prop) {
    // 1. Rellena los datos principales
    document.getElementById('propertyTitle').textContent = prop.title || prop.type.toUpperCase();
    document.getElementById('propertyAccommodation').textContent = `${getSpanishName(prop.type)} en ${getSpanishName(prop.accommodationType)}`;
    document.getElementById('propertyPrice').textContent = formatPrice(prop.price);
    document.getElementById('propertyType').textContent = prop.type;//
    
    // Rellena la tabla de características
    document.getElementById('propertyRooms').textContent = prop.rooms;
    document.getElementById('propertyBathrooms').textContent = prop.bathrooms;
    document.getElementById('propertyNeighborhood').textContent = prop.neighborhood;
    
    // Rellena la descripción
    document.getElementById('propertyDescription').textContent = prop.description;
    
    // Rellena las características booleanas (ESTOS ERAN LOS ID FALTANTES EN EL HTML)
    document.getElementById('hasPatio').textContent = prop.hasPatio ? 'Sí' : 'No';
    document.getElementById('hasParking').textContent = prop.hasParking ? 'Sí' : 'No';
    document.getElementById('amueblado').textContent = prop.hasAmueblado ? 'Sí' : 'No';

    console.dir(prop);
    // 2. Inicializar galería
    if (propertyImages.length > 0) {
        // La primera imagen se carga automáticamente
        updateMainImage(); 
        // Si propertyImages tiene más de 1 elemento, renderiza las miniaturas
        if (propertyImages.length > 1) {
            renderThumbnails(); 
        } else {
            // Ocultar botones de navegación si solo hay una imagen
            document.getElementById('prevImageBtn').classList.add('hidden');
            document.getElementById('nextImageBtn').classList.add('hidden');
            document.getElementById('thumbnailGrid').classList.add('hidden');
        }
    } else {
        // Imagen por defecto si no hay ninguna
        document.getElementById('mainImage').src = '/img/default-image.jpg'; 
    }
    
    // 3. Inicializar servicios y mapa
    renderServices(prop.facility, 'facilitiesList');
    renderServices(prop.roomService, 'roomServicesList');
    renderServices(prop.groupType, 'groupTypesList');
    renderServices(prop.funType, 'funTypesList');
    
    initMap(); 
}

// ==========================================
// LÓGICA DE GALERÍA DE IMÁGENES
// ==========================================

function renderThumbnails() {
    const container = document.getElementById('thumbnailGrid');
    container.innerHTML = propertyImages.map((img, index) => `
        <div class="thumbnail-item ${index === currentImageIndex ? 'active' : ''}" data-index="${index}">
            <img src="${img}" alt="Miniatura ${index + 1}" />
        </div>
    `).join('');
    
    // Event listeners para thumbnails
    container.querySelectorAll('.thumbnail-item').forEach(item => {
        item.addEventListener('click', () => {
            currentImageIndex = parseInt(item.dataset.index);
            updateMainImage();
        });
    });
}

function updateMainImage() {
    document.getElementById('mainImage').src = propertyImages[currentImageIndex];
    renderThumbnails(); // Para actualizar el borde activo
}

function navigateImages(direction) {
    if (propertyImages.length <= 1) return;

    let newIndex = currentImageIndex + direction;
    if (newIndex < 0) {
        newIndex = propertyImages.length - 1;
    } else if (newIndex >= propertyImages.length) {
        newIndex = 0;
    }
    currentImageIndex = newIndex;
    updateMainImage();
}

// ==========================================
// LÓGICA DEL MAPA (Leaflet)
// ==========================================

function initMap() {
    const prop = currentProperty;
    if (!prop || !prop.lat || !prop.lng) {
        console.error("Coordenadas no válidas para el mapa.");
        document.getElementById('propertyMap').innerHTML = 
            '<p>Ubicación no disponible.</p>';
        return;
    }

    // Asegurarse de que el mapa se inicialice una sola vez
    if (document.getElementById('propertyMap')._leaflet_id) {
        document.getElementById('propertyMap')._leaflet_id = null;
    }
    
    const propertyMap = L.map('propertyMap', {
        zoomControl: true,
        scrollWheelZoom: true
    }).setView([prop.lat, prop.lng], 15);
    
    L.tileLayer('https://wms.ign.gob.ar/geoserver/gwc/service/tms/1.0.0/capabaseargenmap@EPSG%3A3857@png/{z}/{x}/{-y}.png', {
        minZoom: 10,
        maxZoom: 18,
        attribution: '© IGN Argentina'
    }).addTo(propertyMap);
    
    // Agregar marcador (Usamos el pin personalizado si lo tienes)
    L.marker([prop.lat, prop.lng], {
        icon: L.icon({
            iconUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.4.0/images/marker-icon.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.4.0/images/marker-shadow.png',
            shadowSize: [41, 41]
        })
    }).addTo(propertyMap);

    // Mostrar las coordenadas
    document.getElementById('displayLat').textContent = prop.lat.toFixed(6);
    document.getElementById('displayLng').textContent = prop.lng.toFixed(6);
}


// ==========================================
// INICIALIZACIÓN GLOBAL
// ==========================================
document.addEventListener('DOMContentLoaded', () => {
    
    // Agregar event listeners para la navegación de imágenes
    const prevBtn = document.getElementById('prevImageBtn');
    const nextBtn = document.getElementById('nextImageBtn');

    if (prevBtn) {
        prevBtn.addEventListener('click', () => navigateImages(-1));
    }
    if (nextBtn) {
        nextBtn.addEventListener('click', () => navigateImages(1));
    }

    // 🚨 LLAMADA PRINCIPAL: Usar la variable inyectada desde Blade
    if (typeof PROPERTY_ID !== 'undefined' && PROPERTY_ID !== null) {
        loadPropertyDetails(PROPERTY_ID);
    } else {
        console.error("Error: PROPERTY_ID global no definido o nulo.");
        document.querySelector('.detail-container').innerHTML = 
            '<h2>Error de Carga</h2><p>No se pudo determinar la propiedad a cargar.</p>';
    }
});