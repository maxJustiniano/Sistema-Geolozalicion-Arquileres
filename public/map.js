const sampleProperties = [
    { id: 1, type: 'casa', neighborhood: 'Centro', rooms: 3, bathrooms: 2, price: 8000000, hasPatio: true, hasAmueblado: true, hasParking: true, hasPool: false, petsAllowed: true, lat: -26.1773, lng: -58.1810, reference: 'cerca de Plaza San Martín', description: 'Casa acogedora en el corazón de Formosa.' },
    { id: 3, type: 'terreno', neighborhood: 'Guadalupe', rooms: 3, bathrooms: 2, price: 3000000, hasPatio: false, hasAmueblado: false, hasParking: false, hasPool: false, petsAllowed: true, lat: -26.1700, lng: -58.1900, reference: 'cerca de Iglesia Guadalupe', description: 'Terreno ideal para construir.' },
    { id: 4, type: 'ph', neighborhood: 'La Esmeralda', rooms: 1, bathrooms: 1, price: 3500000, hasPatio: true, hasAmueblado: true, hasParking: true, hasPool: false, petsAllowed: true, lat: -26.1820, lng: -58.1680, reference: 'cerca de Parque Libertad', description: 'PH luminoso y renovado.' },
    { id: 5, type: 'casa', neighborhood: 'Centro', rooms: 4, bathrooms: 3, price: 12000000, hasPatio: true, hasAmueblado: true, hasParking: true, hasPool: true, petsAllowed: false, lat: -26.1750, lng: -58.1850, reference: 'cerca de Plaza San Martín', description: 'Casa familiar con pileta.' },
    { id: 6, type: 'departamento', neighborhood: 'San Martín', rooms: 3, bathrooms: 2, price: 6500000, hasPatio: false, hasAmueblado: true, hasParking: true, hasPool: false, petsAllowed: true, lat: -26.1800, lng: -58.1780, reference: 'cerca de Costanera', description: 'Depto espacioso con balcón.' },
    { id: 7, type: 'terreno', neighborhood: 'Norte', rooms: 2, bathrooms: 1, price: 4500000, hasPatio: false, hasAmueblado: false, hasParking: false, hasPool: false, petsAllowed: false, lat: -26.1650, lng: -58.1820, reference: 'cerca de Ruta Nacional 11', description: 'Terreno en zona en crecimiento.' },
    { id: 8, type: 'casa', neighborhood: 'Guadalupe', rooms: 2, bathrooms: 1, price: 7000000, hasPatio: true, hasAmueblado: false, hasParking: false, hasPool: false, petsAllowed: true, lat: -26.1720, lng: -58.1880, reference: 'cerca de Iglesia Guadalupe', description: 'Casa sencilla con patio amplio.' },
    { id: 9, type: 'ph', neighborhood: 'La Esmeralda', rooms: 2, bathrooms: 2, price: 5500000, hasPatio: false, hasAmueblado: true, hasParking: true, hasPool: true, petsAllowed: false, lat: -26.1840, lng: -58.1700, reference: 'cerca de Parque Libertad', description: 'PH con pileta compartida.' },
    { id: 10, type: 'departamento', neighborhood: 'Sur', rooms: 1, bathrooms: 1, price: 4000000, hasPatio: true, hasAmueblado: true, hasParking: false, hasPool: false, petsAllowed: true, lat: -26.1900, lng: -58.1800, reference: 'cerca de Terminal de Ómnibus', description: 'Depto céntrico y accesible.' }
];

const prices = sampleProperties.map(p => p.price);
const realMinPrice = Math.min(...prices);
const realMaxPrice = Math.max(...prices);

var map;
var allMarkers = [];
var argenmap = L.tileLayer('https://wms.ign.gob.ar/geoserver/gwc/service/tms/1.0.0/capabaseargenmap@EPSG%3A3857@png/{z}/{x}/{-y}.png', {
    minZoom: 10, maxZoom: 18,
    attribution: '© IGN Argentina'
});

function saveFilters() {
    const filters = {
        propertyType: $('#propertyType').val(),
        neighborhood: $('#neighborhood').val(),
        minRooms: $('#minRooms').val(),
        minBathrooms: $('#minBathrooms').val(),
        minPrice: $('#minPrice').val(),
        maxPrice: $('#maxPrice').val(),
        hasPatio: $('#hasPatio').is(':checked'),
        hasAmueblado: $('#hasAmueblado').is(':checked'),
        hasParking: $('#hasParking').is(':checked'),
        hasPool: $('#hasPool').is(':checked'),
        petsAllowed: $('#petsAllowed').is(':checked'),
        referencePlace: $('#referencePlace').val(),
        sidebarCollapsed: $('#sidebar').hasClass('collapsed') || false,
        sidebarOpenMobile: $('#sidebar').hasClass('open') || false
    };
    localStorage.setItem('propertyFilters', JSON.stringify(filters));
}

function loadFilters() {
    const saved = localStorage.getItem('propertyFilters');
    if (saved) {
        const filters = JSON.parse(saved);
        $('#propertyType').val(filters.propertyType || '');
        $('#neighborhood').val(filters.neighborhood || '');
        $('#minRooms').val(filters.minRooms || 0);
        $('#minBathrooms').val(filters.minBathrooms || 0);
        
        let clampedMin = Math.max(realMinPrice, parseInt(filters.minPrice) || realMinPrice);
        let clampedMax = Math.min(realMaxPrice, parseInt(filters.maxPrice) || realMaxPrice);
        if (clampedMin > clampedMax) {
            clampedMax = clampedMin;
        }
        $('#minPrice').val(clampedMin);
        $('#maxPrice').val(clampedMax);
        
        $('#hasPatio').prop('checked', filters.hasPatio || false);
        $('#hasAmueblado').prop('checked', filters.hasAmueblado || false);
        $('#hasParking').prop('checked', filters.hasParking || false);
        $('#hasPool').prop('checked', filters.hasPool || false);
        $('#petsAllowed').prop('checked', filters.petsAllowed || false);
        $('#referencePlace').val(filters.referencePlace || '');

        $('#priceRangeDisplay').text(`${formatPrice(clampedMin)} - ${formatPrice(clampedMax)} ARS`);

        if (window.innerWidth > 768) {
            if (filters.sidebarCollapsed) {
                $('#sidebar').addClass('collapsed');
                $('#map').addClass('expanded').removeClass('sidebar-open');
                $('#toggleFiltersBtn').html('<i class="fas fa-filter"></i> Mostrar Filtros');
            } else {
                $('#sidebar').removeClass('collapsed');
                $('#map').removeClass('expanded').addClass('sidebar-open');
                $('#toggleFiltersBtn').html('<i class="fas fa-filter"></i> Ocultar Filtros');
            }
        } else {
            if (filters.sidebarOpenMobile) {
                $('#sidebar').addClass('open');
            }
        }

        applyFilters();
    }
}
// la linea 91  limita el mapa al area de Formosa Capital, lo vi mas logico para que no se vea el mapa del mundo en si xd
$(function () {
    const formosaBounds = L.latLngBounds(
        L.latLng(-26.25, -58.25), 
        L.latLng(-26.10, -58.05)  
    );

    map = L.map('map', {
        center: L.latLng(-26.1773, -58.1810),
        zoom: 13,
        minZoom: 11,
        maxZoom: 18,
        zoomControl: true,
        layers: [argenmap],
        maxBounds: formosaBounds,
        maxBoundsViscosity: 1.0
    });

    map.fitBounds(formosaBounds, { padding: [20, 20] });

    addAllMarkers();

    $('#minPrice, #maxPrice').on('input', function() {
        let min = Math.max(realMinPrice, parseInt($('#minPrice').val()) || realMinPrice);
        let max = Math.min(realMaxPrice, parseInt($('#maxPrice').val()) || realMaxPrice);
        if (min > max) {
            max = min;
            $('#maxPrice').val(max);
        }
        $('#minPrice').val(min);
        $('#priceRangeDisplay').text(`${formatPrice(min)} - ${formatPrice(max)} ARS`);
        saveFilters();
    });

    const neighborhoods = [...new Set(sampleProperties.map(p => p.neighborhood))];
    $('#neighborhood').on('input', function() {
        const value = $(this).val().toLowerCase();
        saveFilters();
    });

    $('#propertyType, #minRooms, #minBathrooms, #referencePlace, input[type="checkbox"]').on('change', saveFilters);

    $('#applyFilters').on('click', function() {
        applyFilters();
        saveFilters();
    });

    $('#clearFilters').on('click', function() {
        $('#propertyType, #neighborhood, #referencePlace').val('');
        $('#minRooms').val(0);
        $('#minBathrooms').val(0);
        $('#minPrice').val(realMinPrice);
        $('#maxPrice').val(realMaxPrice);
        $('#priceRangeDisplay').text(`${formatPrice(realMinPrice)} - ${formatPrice(realMaxPrice)} ARS`);
        $('input[type="checkbox"]').prop('checked', false);
        applyFilters();
        saveFilters();
    });

    $('#toggleFiltersBtn').on('click', function() {
        const isCollapsed = $('#sidebar').hasClass('collapsed');
        if (isCollapsed) {
            $('#sidebar').removeClass('collapsed');
            $('#map').removeClass('expanded').addClass('sidebar-open');
            $(this).html('<i class="fas fa-filter"></i> Ocultar Filtros');
        } else {
            $('#sidebar').addClass('collapsed');
            $('#map').addClass('expanded').removeClass('sidebar-open');
            $(this).html('<i class="fas fa-filter"></i> Mostrar Filtros');
        }
        saveFilters();
    });

    $('#loginBtn').on('click', function() {
        alert('Funcionalidad de login en desarrollo. Redirigiendo a página de inicio de sesión...');
    });

    $('#toggleSidebar').on('click', function() {
        $('#sidebar').toggleClass('open');
        const isOpen = $('#sidebar').hasClass('open');
        saveFilters();
        if (isOpen) {
            $('#toggleSidebar').html('<i class="fas fa-times"></i>');
        } else {
            $('#toggleSidebar').html('<i class="fas fa-bars"></i>');
        }
    });

    loadFilters();

    if ($('#sidebar').hasClass('collapsed')) {
        $('#map').addClass('expanded');
    } else {
        $('#map').addClass('sidebar-open');
    }
});

function addAllMarkers() {
    sampleProperties.forEach(function(property) {
        const iconClass = property.type === 'casa' ? 'fa-home' : 
                         property.type === 'departamento' ? 'fa-building' : 
                         property.type === 'terreno' ? 'fa-map' : 'fa-door-open';
        const marker = L.marker([property.lat, property.lng]).addTo(map);
        marker.bindPopup(`
            <div style="font-family: Roboto, sans-serif; max-width: 250px;">
                <b><i class="fas fa-${iconClass}"></i> ${property.type.toUpperCase()} en ${property.neighborhood}</b><br>
                <i class="fas fa-bed"></i> Habitaciones: ${property.rooms} | <i class="fas fa-bath"></i> Baños: ${property.bathrooms}<br>
                <i class="fas fa-dollar-sign"></i> Precio: ${formatPrice(property.price)} ARS<br>
                ${property.description}<br>
                <small><i class="fas fa-map-marker-alt"></i> ${property.reference}</small><br>
                <em>Amenidades: ${getAmenitiesString(property)}</em>
            </div>
        `);
        marker.propertyData = property;
        allMarkers.push(marker);
    });

    if (allMarkers.length > 0) {
        const group = new L.featureGroup(allMarkers);
        map.fitBounds(group.getBounds(), { padding: [20, 20], maxZoom: 15 });
    }
}

function applyFilters() {
    const filters = {
        type: $('#propertyType').val(),
        neighborhood: $('#neighborhood').val().toLowerCase(),
        minRooms: parseInt($('#minRooms').val()) || 0,
        minBathrooms: parseInt($('#minBathrooms').val()) || 0,
        minPrice: parseInt($('#minPrice').val()) || realMinPrice,
        maxPrice: parseInt($('#maxPrice').val()) || realMaxPrice,
        hasPatio: $('#hasPatio').is(':checked'),
        hasAmueblado: $('#hasAmueblado').is(':checked'),
        hasParking: $('#hasParking').is(':checked'),
        hasPool: $('#hasPool').is(':checked'),
        petsAllowed: $('#petsAllowed').is(':checked'),
        reference: $('#referencePlace').val().toLowerCase()
    };

    allMarkers.forEach(marker => {
        map.removeLayer(marker);
    });

    const filteredMarkers = allMarkers.filter(marker => {
        const prop = marker.propertyData;
        return (
            (!filters.type || prop.type === filters.type) &&
            (!filters.neighborhood || prop.neighborhood.toLowerCase().includes(filters.neighborhood)) &&
            (prop.rooms >= filters.minRooms) &&
            (prop.bathrooms >= filters.minBathrooms) &&
            (prop.price >= filters.minPrice && prop.price <= filters.maxPrice) &&
            (!filters.hasPatio || prop.hasPatio) &&
            (!filters.hasAmueblado || prop.hasAmueblado) &&
            (!filters.hasParking || prop.hasParking) &&
            (!filters.hasPool || prop.hasPool) &&
            (!filters.petsAllowed || prop.petsAllowed) &&
            (!filters.reference || prop.reference.toLowerCase().includes(filters.reference))
        );
    });

    filteredMarkers.forEach(marker => {
        marker.addTo(map);
    });

    if (filteredMarkers.length > 0) {
        const group = new L.featureGroup(filteredMarkers);
        map.fitBounds(group.getBounds(), { padding: [20, 20], maxZoom: 15 });
    } else {
        map.setView([-26.1773, -58.1810], 13);
    }

    console.log(`Mostrando ${filteredMarkers.length} propiedades filtradas.`);
}

function formatPrice(price) {
    return new Intl.NumberFormat('es-AR').format(price);
}

function getAmenitiesString(prop) {
    const amenities = [];
    if (prop.hasPatio) amenities.push('Patio');
    if (prop.hasAmueblado) amenities.push('Amueblado');
    if (prop.hasParking) amenities.push('Estacionamiento');
    if (prop.hasPool) amenities.push('Pileta');
    if (prop.petsAllowed) amenities.push('Mascotas OK');
    return amenities.join(', ') || 'Ninguna';
}