// Datos de propiedades 
const sampleProperties = [
    { id: 1, type: 'casa', accommodationType: 'casa_chalet', neighborhood: 'Centro', rooms: 3, bathrooms: 2, price: 8000000, hasPatio: true, hasAmueblado: true, hasParking: true, hasPool: false, petsAllowed: true, lat: -26.1773, lng: -58.1810, reference: 'cerca de Plaza San Martín', description: 'Casa acogedora en el corazón de Formosa.', facility: ['estacionamiento', 'wifi_gratis'], roomService: ['bano_privado', 'cocina', 'aire_acondicionado'], groupType: ['admite_mascotas'] },
    { id: 3, type: 'terreno', accommodationType: 'alquiler', neighborhood: 'Guadalupe', rooms: 0, bathrooms: 0, price: 3000000, hasPatio: false, hasAmueblado: false, hasParking: false, hasPool: false, petsAllowed: true, lat: -26.1700, lng: -58.1900, reference: 'cerca de Iglesia Guadalupe', description: 'Terreno ideal para construir.', facility: [], roomService: [], groupType: ['admite_mascotas'] },
    { id: 4, type: 'ph', accommodationType: 'habitacion_particular', neighborhood: 'La Esmeralda', rooms: 1, bathrooms: 1, price: 3500000, hasPatio: true, hasAmueblado: true, hasParking: true, hasPool: false, petsAllowed: true, lat: -26.1820, lng: -58.1680, reference: 'cerca de Parque Libertad', description: 'PH luminoso y renovado.', facility: ['estacionamiento', 'wifi_gratis'], roomService: ['bano_privado', 'cocina'], groupType: ['admite_mascotas', 'solo_adultos'] },
    { id: 5, type: 'casa', accommodationType: 'casa_chalet', neighborhood: 'Centro', rooms: 4, bathrooms: 3, price: 12000000, hasPatio: true, hasAmueblado: true, hasParking: true, hasPool: true, petsAllowed: false, lat: -26.1750, lng: -58.1850, reference: 'cerca de Plaza San Martín', description: 'Casa familiar con pileta.', facility: ['estacionamiento', 'piscina', 'jacuzzi', 'wifi_gratis'], roomService: ['bano_privado', 'piscina_privada', 'cocina', 'banera_hidromasaje_habitacion', 'sauna', 'chimenea'], groupType: [] },
    { id: 6, type: 'departamento', accommodationType: 'apartamento', neighborhood: 'San Martín', rooms: 3, bathrooms: 2, price: 6500000, hasPatio: false, hasAmueblado: true, hasParking: true, hasPool: false, petsAllowed: true, lat: -26.1800, lng: -58.1780, reference: 'cerca de Costanera', description: 'Depto espacioso con balcón.', facility: ['estacionamiento', 'gimnasio', 'wifi_gratis'], roomService: ['balcon', 'acceso_ascensor', 'tv_pantalla_plana'], groupType: ['admite_mascotas'] },
    { id: 7, type: 'terreno', accommodationType: 'alquiler', neighborhood: 'Norte', rooms: 0, bathrooms: 0, price: 4500000, hasPatio: false, hasAmueblado: false, hasParking: false, hasPool: false, petsAllowed: false, lat: -26.1650, lng: -58.1820, reference: 'cerca de Ruta Nacional 11', description: 'Terreno en zona en crecimiento.', facility: [], roomService: [], groupType: [] },
    { id: 8, type: 'casa', accommodationType: 'cabana', neighborhood: 'Guadalupe', rooms: 2, bathrooms: 1, price: 7000000, hasPatio: true, hasAmueblado: false, hasParking: false, hasPool: false, petsAllowed: true, lat: -26.1720, lng: -58.1880, reference: 'cerca de Iglesia Guadalupe', description: 'Casa sencilla con patio amplio.', facility: ['estacionamiento'], roomService: ['chimenea', 'vistas_montana'], groupType: ['admite_mascotas'] },
    { id: 9, type: 'ph', accommodationType: 'villa', neighborhood: 'La Esmeralda', rooms: 2, bathrooms: 2, price: 5500000, hasPatio: false, hasAmueblado: true, hasParking: true, hasPool: true, petsAllowed: false, lat: -26.1840, lng: -58.1700, reference: 'cerca de Parque Libertad', description: 'PH con pileta compartida.', facility: ['piscina', 'jacuzzi', 'spa_bienestar', 'wifi_gratis'], roomService: ['banera_hidromasaje_habitacion', 'sauna', 'vistas'], groupType: ['solo_adultos'] },
    { id: 10, type: 'departamento', accommodationType: 'apartamento', neighborhood: 'Sur', rooms: 1, bathrooms: 1, price: 4000000, hasPatio: true, hasAmueblado: true, hasParking: false, hasPool: false, petsAllowed: true, lat: -26.1900, lng: -58.1800, reference: 'cerca de Terminal de Ómnibus', description: 'Depto céntrico y accesible.', facility: ['restaurante', 'servicio_habitaciones'], roomService: ['bano_privado', 'tv_pantalla_plana'], groupType: ['admite_mascotas'] },
    { id: 11, type: 'casa', accommodationType: 'casa_chalet', neighborhood: 'Eva Perón', rooms: 3, bathrooms: 2, price: 8900000, hasPatio: true, hasAmueblado: false, hasParking: true, hasPool: false, petsAllowed: true, lat: -26.1885, lng: -58.1672, reference: 'cerca del Hospital Central', description: 'Casa cómoda con patio y cochera cubierta.', facility: ['estacionamiento'], roomService: ['bano_privado', 'cocina'], groupType: [] },
    { id: 12, type: 'departamento', accommodationType: 'apartamento', neighborhood: 'Centro', rooms: 2, bathrooms: 1, price: 6200000, hasPatio: false, hasAmueblado: true, hasParking: false, hasPool: false, petsAllowed: false, lat: -26.1832, lng: -58.1768, reference: 'a 2 cuadras de la Plaza San Martín', description: 'Departamento amoblado listo para habitar.', facility: ['wifi_gratis', 'recepcion_24_horas'], roomService: ['balcon', 'tv_pantalla_plana'], groupType: [] },
    { id: 14, type: 'casa', accommodationType: 'villa', neighborhood: 'La Pilar', rooms: 4, bathrooms: 3, price: 14500000, hasPatio: true, hasAmueblado: true, hasParking: true, hasPool: true, petsAllowed: false, lat: -26.1656, lng: -58.1965, reference: 'zona residencial tranquila', description: 'Villa amplia con jardín y pileta.', facility: ['piscina', 'estacionamiento', 'jacuzzi'], roomService: ['piscina_privada', 'sauna'], groupType: [] },
    { id: 15, type: 'terreno', accommodationType: 'alquiler', neighborhood: 'Virgen del Carmen', rooms: 0, bathrooms: 0, price: 3600000, hasPatio: false, hasAmueblado: false, hasParking: false, hasPool: false, petsAllowed: false, lat: -26.1959, lng: -58.1705, reference: 'cercano a Ruta 11', description: 'Terreno nivelado listo para construir.', facility: [], roomService: [], groupType: [] }
];

// Mapeo de tipos de propiedad
const propertyTypeLabels = {
    'apartamento': 'Departamento',
    'casa_chalet': 'Casa / Chalet',
    'habitacion_particular': 'Habitación Particular',
    'alquiler': 'Terreno / Alquiler',
    'villa': 'Villa',
    'cabana': 'Cabaña',
    'albergue': 'Albergue',
    'hotel': 'Hotel',
    'residencial': 'Residencial',
    'camping': 'Camping'
};

// Mapeo de servicios
const serviceLabels = {
    // Instalaciones
    'estacionamiento': 'Estacionamiento',
    'restaurante': 'Restaurante',
    'servicio_habitaciones': 'Servicio de habitaciones',
    'recepcion_24_horas': 'Recepción 24 horas',
    'gimnasio': 'Gimnasio',
    'traslado_aeropuerto': 'Traslado aeropuerto',
    'spa_bienestar': 'Spa y centro de bienestar',
    'banera_hidromasaje': 'Bañera hidromasaje',
    'jacuzzi': 'Jacuzzi',
    'wifi_gratis': 'Wifi Gratis',
    'estacion_carga_vehiculos_electricos': 'Estación de carga de vehículos eléctricos',
    'adaptado_sillas_ruedas': 'Adaptado para sillas de ruedas',
    'piscina': 'Piscina',
    // Servicios de habitación
    'bano_privado': 'Baño privado',
    'piscina_privada': 'Piscina privada',
    'balcon': 'Balcón',
    'aire_acondicionado': 'Aire acondicionado',
    'cocina': 'Cocina',
    'banera_hidromasaje_habitacion': 'Bañera de hidromasaje',
    'vistas': 'Vistas',
    'banera': 'Bañera',
    'sauna': 'Sauna',
    'chimenea': 'Chimenea',
    'vistas_montana': 'Vistas a la montaña',
    'acceso_ascensor': 'Acceso a pisos superiores en ascensor',
    'tv_pantalla_plana': 'TV de pantalla plana',
    // Tipo de grupo
    'admite_mascotas': 'Admite mascotas',
    'solo_adultos': 'Solo para adultos',
    // Para pasarlo bien
    'sala_juegos': 'Sala de juegos',
    'cine': 'Cine'
};

let currentProperty = null;
let currentImageIndex = 0;
let propertyImages = [];

document.addEventListener('DOMContentLoaded', () => {
    // Obtener ID de la propiedad desde la URL
    const urlParams = new URLSearchParams(window.location.search);
    const propertyId = parseInt(urlParams.get('id'));
    
    if (!propertyId) {
        alert('Propiedad no encontrada');
        window.location.href = 'index.html';
        return;
    }
    
    // Buscar la propiedad
    currentProperty = sampleProperties.find(p => p.id === propertyId);
    
    if (!currentProperty) {
        alert('Propiedad no encontrada');
        window.location.href = 'index.html';
        return;
    }
    
    // Cargar datos de la propiedad
    loadPropertyData();
    initImageGallery();
    initMap();
});

function formatPrice(price) {
    return new Intl.NumberFormat('es-AR').format(price);
}

function loadPropertyData() {
    const prop = currentProperty;
    
    // Título
    const typeLabel = propertyTypeLabels[prop.accommodationType] || prop.type;
    document.getElementById('propertyTitle').textContent = `${typeLabel} en ${prop.neighborhood}`;
    
    // Ubicación
    document.getElementById('propertyNeighborhood').textContent = prop.neighborhood;
    document.getElementById('propertyReference').textContent = prop.reference;
    
    // Detalles
    document.getElementById('propertyType').textContent = typeLabel;
    document.getElementById('propertyRooms').textContent = prop.rooms || '0';
    document.getElementById('propertyBathrooms').textContent = prop.bathrooms || '0';
    document.getElementById('propertyPrice').textContent = `${formatPrice(prop.price)} ARS`;
    
    // Descripción
    document.getElementById('propertyDescription').textContent = prop.description;
    
    // Servicios
    renderServices('facilitiesList', prop.facility || [], 'facilitiesSection');
    renderServices('roomServicesList', prop.roomService || [], 'roomServicesSection');
    renderServices('groupTypesList', prop.groupType || [], 'groupTypesSection');
    
    // Para pasarlo bien 
    const funTypes = [];
    if (prop.facility) {
        if (prop.facility.includes('piscina')) funTypes.push('piscina');
        if (prop.facility.includes('sala_juegos')) funTypes.push('sala_juegos');
        if (prop.facility.includes('cine')) funTypes.push('cine');
    }
    if (prop.roomService) {
        if (prop.roomService.includes('piscina_privada')) funTypes.push('piscina');
    }
    renderServices('funTypesList', funTypes, 'funTypesSection');
    
    // Coordenadas
    document.getElementById('displayLat').textContent = prop.lat.toFixed(6);
    document.getElementById('displayLng').textContent = prop.lng.toFixed(6);
}

function renderServices(containerId, services, sectionId) {
    const container = document.getElementById(containerId);
    const section = document.getElementById(sectionId);
    
    if (!services || services.length === 0) {
        container.innerHTML = '<div class="service-empty">No especificado</div>';
        return;
    }
    
    container.innerHTML = services.map(service => {
        const label = serviceLabels[service] || service;
        return `
            <div class="service-item">
                <i class="fas fa-check-circle"></i>
                <span>${label}</span>
            </div>
        `;
    }).join('');
}

function initImageGallery() {
    // Generar imágenes de ejemplo
    propertyImages = [
        'https://via.placeholder.com/800x450?text=Imagen+1',
        'https://via.placeholder.com/800x450?text=Imagen+2',
        'https://via.placeholder.com/800x450?text=Imagen+3',
        'https://via.placeholder.com/800x450?text=Imagen+4'
    ];
    
    // Mostrar primera imagen
    if (propertyImages.length > 0) {
        document.getElementById('mainImage').src = propertyImages[0];
        renderThumbnails();
    }
    
    // Event listeners para navegación
    document.getElementById('prevImageBtn').addEventListener('click', () => {
        currentImageIndex = (currentImageIndex - 1 + propertyImages.length) % propertyImages.length;
        updateMainImage();
    });
    
    document.getElementById('nextImageBtn').addEventListener('click', () => {
        currentImageIndex = (currentImageIndex + 1) % propertyImages.length;
        updateMainImage();
    });
}

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
    renderThumbnails();
}

function initMap() {
    const prop = currentProperty;
    const propertyMap = L.map('propertyMap', {
        zoomControl: true,
        scrollWheelZoom: true
    }).setView([prop.lat, prop.lng], 15);
    
    L.tileLayer('https://wms.ign.gob.ar/geoserver/gwc/service/tms/1.0.0/capabaseargenmap@EPSG%3A3857@png/{z}/{x}/{-y}.png', {
        minZoom: 10,
        maxZoom: 18,
        attribution: '© IGN Argentina'
    }).addTo(propertyMap);
    
    // Agregar marcador
    L.marker([prop.lat, prop.lng], {
        icon: L.icon({
            iconUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.4.0/images/marker-icon.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41]
        })
    }).addTo(propertyMap).bindPopup(`<strong>${prop.neighborhood}</strong><br>${prop.reference}`);
}

