// Los pines de las propiedades.
let sampleProperties = [];

fetch('/propiedades-mapa')
    .then(response => response.json())
    .then(json => {
        // Laravel Resources devuelve los datos dentro de una propiedad "data"
        sampleProperties = json.data;
        
        // Aquí llamas a tu función que inicia el mapa
        addAllMarkers();
    });

const prices = sampleProperties.map(p => p.price);
const realMinPrice = Math.min(...prices);
const realMaxPrice = Math.max(...prices);

var map;
var allMarkers = [];
var markerClusterGroup;
var argenmap = L.tileLayer('https://wms.ign.gob.ar/geoserver/gwc/service/tms/1.0.0/capabaseargenmap@EPSG%3A3857@png/{z}/{x}/{-y}.png', {
    minZoom: 10, maxZoom: 18,
    attribution: '© IGN Argentina'
});

// Función para formatear números con separadores de miles (formato argentino)
function formatNumberWithThousands(numStr) {
    // Remover todo excepto números
    const numbersOnly = numStr.replace(/[^\d]/g, '');
    if (!numbersOnly) return '';
    
    // Formatear con separadores de miles (punto como separador)
    return numbersOnly.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
}

// Función para obtener el número puro sin formato
function getNumericValue(formattedStr) {
    if (!formattedStr) return null;
    const numbersOnly = formattedStr.replace(/[^\d]/g, '');
    return numbersOnly ? parseInt(numbersOnly) : null;
}

function formatPrice(price) {
    return new Intl.NumberFormat('es-AR').format(price);
}

function saveFilters() {
    const minPriceVal = getNumericValue($('#minPrice').val());
    const maxPriceVal = getNumericValue($('#maxPrice').val());
    
    const filters = {
        accommodationTypes: $('.accommodation-type:checked').map(function() { return this.value; }).get(),
        facilities: $('.facility:checked').map(function() { return this.value; }).get(),
        roomServices: $('.room-service:checked').map(function() { return this.value; }).get(),
        groupTypes: $('.group-type:checked').map(function() { return this.value; }).get(),
        funTypes: $('.fun-type:checked').map(function() { return this.value; }).get(),
        minRooms: parseInt($('.min-rooms:checked').val()) || 1,
        minBathrooms: parseInt($('.min-bathrooms:checked').val()) || 1,
        minPrice: minPriceVal !== null ? minPriceVal.toString() : '',
        maxPrice: maxPriceVal !== null ? maxPriceVal.toString() : '',
        sidebarCollapsed: $('#sidebar').hasClass('collapsed') || false,
        sidebarOpenMobile: $('#sidebar').hasClass('open') || false
    };
    localStorage.setItem('propertyFilters', JSON.stringify(filters));
}

function loadFilters() {
    const saved = localStorage.getItem('propertyFilters');
    if (saved) {
        const filters = JSON.parse(saved);
        
        if(filters.accommodationTypes) {
            filters.accommodationTypes.forEach(val => $(`.accommodation-type[value="${val}"]`).prop('checked', true));
        }
        if(filters.facilities) {
            filters.facilities.forEach(val => $(`.facility[value="${val}"]`).prop('checked', true));
        }
        if(filters.roomServices) {
            filters.roomServices.forEach(val => $(`.room-service[value="${val}"]`).prop('checked', true));
        }
        if(filters.groupTypes) {
            filters.groupTypes.forEach(val => $(`.group-type[value="${val}"]`).prop('checked', true));
        }
        if(filters.funTypes) {
            filters.funTypes.forEach(val => $(`.fun-type[value="${val}"]`).prop('checked', true));
        }

        if (filters.minRooms) {
            $(`.min-rooms[value="${filters.minRooms}"]`).prop('checked', true);
        } else {
            $('.min-rooms[value="1"]').prop('checked', true);
        }
        
        if (filters.minBathrooms) {
            $(`.min-bathrooms[value="${filters.minBathrooms}"]`).prop('checked', true);
        } else {
            $('.min-bathrooms[value="1"]').prop('checked', true);
        }
        
        // Solo cargar valores si existen y no están vacíos
        if (filters.minPrice && filters.minPrice.trim() !== '') {
            const minNum = parseInt(filters.minPrice);
            if (!isNaN(minNum)) {
                $('#minPrice').val(formatNumberWithThousands(filters.minPrice));
            } else {
                $('#minPrice').val('');
            }
        } else {
            $('#minPrice').val('');
        }
        
        if (filters.maxPrice && filters.maxPrice.trim() !== '') {
            const maxNum = parseInt(filters.maxPrice);
            if (!isNaN(maxNum)) {
                $('#maxPrice').val(formatNumberWithThousands(filters.maxPrice));
            } else {
                $('#maxPrice').val('');
            }
        } else {
            $('#maxPrice').val('');
        }
        
        const minVal = getNumericValue($('#minPrice').val());
        const maxVal = getNumericValue($('#maxPrice').val());
        if (minVal !== null && maxVal !== null) {
            $('#priceRangeDisplay').text(`${formatPrice(minVal)} - ${formatPrice(maxVal)} ARS`);
        } else if (minVal !== null) {
            $('#priceRangeDisplay').text(`Desde ${formatPrice(minVal)} ARS`);
        } else if (maxVal !== null) {
            $('#priceRangeDisplay').text(`Hasta ${formatPrice(maxVal)} ARS`);
        } else {
            $('#priceRangeDisplay').text('');
        }
        



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

$(function () {
    const formosaBounds = L.latLngBounds(
        L.latLng(-26.25, -58.25), // Southwest
        L.latLng(-26.10, -58.05)  // Northeast (área de Formosa Capital y alrededores)
    );

    map = L.map('map', {
        center: L.latLng(-26.1773, -58.1810),
        zoom: 13,
        minZoom: 11, maxZoom: 18,
        zoomControl: true,
        layers: [argenmap],
        maxBounds: formosaBounds,
        maxBoundsViscosity: 1.0
    });

    map.fitBounds(formosaBounds, { padding: [20, 20] });

    addAllMarkers();

    $('#minPrice, #maxPrice').on('input', function() {
        const $input = $(this);
        const currentValue = $input.val();
        const cursorPosition = $input[0].selectionStart;
        
        // Contar dígitos antes del cursor
        const digitsBeforeCursor = currentValue.substring(0, cursorPosition).replace(/[^\d]/g, '').length;
        
        // Formatear el número mientras el usuario escribe
        const formatted = formatNumberWithThousands(currentValue);
        $input.val(formatted);
        
        // Calcular nueva posición del cursor
        let newCursorPosition = 0;
        let digitsCounted = 0;
        for (let i = 0; i < formatted.length && digitsCounted < digitsBeforeCursor; i++) {
            if (/W/.test(formatted[i])) {
                digitsCounted++;
            }
            newCursorPosition = i + 1;
        }
        
        // Ajustar si estamos en medio de un separador
        if (newCursorPosition < formatted.length && formatted[newCursorPosition] === '.') {
            newCursorPosition++;
        }
        
        $input[0].setSelectionRange(newCursorPosition, newCursorPosition);
        
        const minVal = getNumericValue($('#minPrice').val());
        const maxVal = getNumericValue($('#maxPrice').val());
        
        if (minVal !== null && maxVal !== null) {
            $('#priceRangeDisplay').text(`${formatPrice(minVal)} - ${formatPrice(maxVal)} ARS`);
        } else if (minVal !== null) {
            $('#priceRangeDisplay').text(`Desde ${formatPrice(minVal)} ARS`);
        } else if (maxVal !== null) {
            $('#priceRangeDisplay').text(`Hasta ${formatPrice(maxVal)} ARS`);
        } else {
            $('#priceRangeDisplay').text('');
        }
        saveFilters();
    });


    $('.filter-title').on('click', function() {
        $(this).closest('.filter-card').toggleClass('collapsed');
    });

    $('#propertyType, input[type="checkbox"], input[type="radio"]').on('change', saveFilters);

    $('#applyFilters').on('click', function() {
        applyFilters();
        saveFilters();
    });

    $('#clearFilters').on('click', function() {
        $('.min-rooms[value="1"]').prop('checked', true);
        $('.min-bathrooms[value="1"]').prop('checked', true);
        $('#minPrice').val('');
        $('#maxPrice').val('');
        $('#priceRangeDisplay').text('');
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
    // Crear el grupo de clusters si no existe
    if (!markerClusterGroup) {
        markerClusterGroup = L.markerClusterGroup({
            chunkedLoading: true,
            maxClusterRadius: 50,
            spiderfyOnMaxZoom: true,
            showCoverageOnHover: false,
            zoomToBoundsOnClick: true,
            iconCreateFunction: function(cluster) {
                const count = cluster.getChildCount();
                let size = 'small';
                if (count > 10) size = 'medium';
                if (count > 50) size = 'large';
                
                return L.divIcon({
                    html: '<div style="background-color: #2196f3; color: white; border-radius: 50%; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; font-weight: bold; border: 3px solid white; box-shadow: 0 2px 8px rgba(0,0,0,0.3);">' + count + '</div>',
                    className: 'marker-cluster',
                    iconSize: L.point(40, 40)
                });
            }
        });
        markerClusterGroup.addTo(map);
    }
    
    // Limpiar marcadores existentes
    markerClusterGroup.clearLayers();
    allMarkers = [];
    
    sampleProperties.forEach(function(property) {
        const iconClass = property.type === 'casa' ? 'fa-home' : 
                         property.type === 'departamento' ? 'fa-building' : 
                         property.type === 'terreno' ? 'fa-map' : 'fa-door-open';
        const marker = L.marker([property.lat, property.lng]);
        
        const popupContent = `
            <div style="font-family: Roboto, sans-serif; max-width: 480px; padding: 5px;">
                <div style=\"width: 100%; height: 180px; overflow: hidden; border-radius: 10px; background: #f2f2f2; display: flex; align-items: center; justify-content: center;">
                    <img src=\"${property.imageUrl}" alt=\"Imagen de la propiedad\" style=\"width: 100%; height: 100%; object-fit: cover;" />
                </div>
                <b style="display:block; margin-top:10px; font-size: 16px; color: #2196f3;"><i class="fas fa-${iconClass}"></i> ${property.type.toUpperCase()} en ${property.neighborhood}</b>
                <div style="margin: 8px 0;">
                    <i class="fas fa-bed"></i> Habitaciones: <strong>${property.rooms}</strong> | 
                    <i class="fas fa-bath"></i> Baños: <strong>${property.bathrooms}</strong>
                </div>
                <div style="margin: 8px 0; font-size: 15px; color: #27ae60;">
                    <i class="fas fa-dollar-sign"></i> Precio: <strong>${formatPrice(property.price)} ARS</strong>
                </div>
                <div style="margin: 8px 0; line-height: 1.5;">
                    ${property.description}
                </div>
                <div style="margin: 8px 0; font-size: 13px; color: #666;">
                    <i class="fas fa-map-marker-alt"></i> ${property.reference}
                </div>
                <div style="margin-top: 10px;">
                    <a href=\"/detalle-inmueble?id=${property.id}\" style=\"color: #1976d2; font-weight: 600; text-decoration: none;\">Más información…</a>
                </div>
            </div>
        `;
        
        marker.bindPopup(popupContent, {
            maxWidth: 450,
            className: 'custom-popup',
            closeButton: false,
            autoClose: false,
            closeOnClick: false,
            offset: [0, -10]
        });
        
        let hoverTimeout;
        
        // Mostrar popup al pasar el mouse por encima
        marker.on('mouseover', function(e) {
            clearTimeout(hoverTimeout);
            this.openPopup();
        });
        
        // Ocultar popup al quitar el mouse con pequeño delay
        marker.on('mouseout', function(e) {
            const marker = this;
            hoverTimeout = setTimeout(function() {
                marker.closePopup();
            }, 400);
        });
        
        // Mantener el popup abierto si el mouse está sobre el popup
        marker.on('popupopen', function(e) {
            const popup = this.getPopup();
            const popupElement = popup.getElement();
            if (popupElement) {
                popupElement.addEventListener('mouseenter', function() {
                    clearTimeout(hoverTimeout);
                });
                popupElement.addEventListener('mouseleave', function() {
                    hoverTimeout = setTimeout(function() {
                        marker.closePopup();
                    }, 400);
                });
            }
        });
        
        marker.propertyData = property;
        allMarkers.push(marker);
        markerClusterGroup.addLayer(marker);
    });

    if (allMarkers.length > 0) {
        map.fitBounds(markerClusterGroup.getBounds(), { padding: [20, 20], maxZoom: 15 });
    }
}

function applyFilters() {
    const filters = {
        accommodationTypes: $('.accommodation-type:checked').map(function() { return this.value; }).get(),
        facilities: $('.facility:checked').map(function() { return this.value; }).get(),
        roomServices: $('.room-service:checked').map(function() { return this.value; }).get(),
        groupTypes: $('.group-type:checked').map(function() { return this.value; }).get(),
        funTypes: $('.fun-type:checked').map(function() { return this.value; }).get(),
        minRooms: parseInt($('.min-rooms:checked').val()) || 1,
        minBathrooms: parseInt($('.min-bathrooms:checked').val()) || 1,
        minPrice: getNumericValue($('#minPrice').val()),
        maxPrice: getNumericValue($('#maxPrice').val())
    };

    // Limpiar el cluster group
    if (markerClusterGroup) {
        markerClusterGroup.clearLayers();
    }

    const filteredMarkers = allMarkers.filter(marker => {
        const prop = marker.propertyData;
        
        // Filtro de tipo de alojamiento
        const accommodationMatch = filters.accommodationTypes.length === 0 || filters.accommodationTypes.includes(prop.accommodationType);
        
        // Filtro de instalaciones - debe tener TODAS las instalaciones seleccionadas
        const facilityMatch = filters.facilities.length === 0 || filters.facilities.every(f => prop.facility && prop.facility.includes(f));
        
        // Filtro de servicios de habitación - debe tener TODOS los servicios seleccionados
        const roomServiceMatch = filters.roomServices.length === 0 || filters.roomServices.every(s => prop.roomService && prop.roomService.includes(s));
        
        // Filtro de tipo de grupo - debe tener TODOS los tipos seleccionados
        const groupTypeMatch = filters.groupTypes.length === 0 || filters.groupTypes.every(g => prop.groupType && prop.groupType.includes(g));
        
        // Filtro de diversión - debe tener TODOS los tipos seleccionados
        // Los fun-types pueden estar en facility (piscina) o roomService (piscina_privada)
        const funTypeMatch = filters.funTypes.length === 0 || filters.funTypes.every(f => {
            // Mapear fun-types a sus equivalentes en facility/roomService
            const funTypeMap = {
                'piscina': ['piscina', 'piscina_privada'],
                'sala_juegos': ['sala_juegos'],
                'cine': ['cine']
            };
            const matches = funTypeMap[f] || [f];
            return matches.some(match => 
                (prop.facility && prop.facility.includes(match)) || 
                (prop.roomService && prop.roomService.includes(match))
            );
        });

        // Lógica especial para "5+ habitaciones" - si selecciona 5, debe mostrar propiedades con 5 o más
        let roomsMatch = true;
        if (filters.minRooms === 5) {
            roomsMatch = prop.rooms >= 5;
        } else {
            roomsMatch = prop.rooms >= filters.minRooms;
        }
        
        // Lógica especial para "4+ baños" - si selecciona 4, debe mostrar propiedades con 4 o más
        let bathroomsMatch = true;
        if (filters.minBathrooms === 4) {
            bathroomsMatch = prop.bathrooms >= 4;
        } else {
            bathroomsMatch = prop.bathrooms >= filters.minBathrooms;
        }

        return (
            accommodationMatch &&
            facilityMatch &&
            roomServiceMatch &&
            groupTypeMatch &&
            funTypeMatch &&
            roomsMatch &&
            bathroomsMatch &&
            (filters.minPrice === null || prop.price >= filters.minPrice) &&
            (filters.maxPrice === null || prop.price <= filters.maxPrice)
        );
    });

    // Agregar marcadores filtrados al cluster group
    filteredMarkers.forEach(marker => {
        markerClusterGroup.addLayer(marker);
    });

    if (filteredMarkers.length > 0) {
        map.fitBounds(markerClusterGroup.getBounds(), { padding: [20, 20], maxZoom: 15 });
    } else {
        map.setView([-26.1773, -58.1810], 13);
    }

    console.log(`Mostrando ${filteredMarkers.length} propiedades filtradas.`);
}
