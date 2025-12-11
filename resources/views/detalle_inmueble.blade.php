<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de Propiedad - Formosa Capital</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.4.0/leaflet.css" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    @vite(['resources/css/detalle_inmueble.css', 'resources/js/detalle_inmueble.js'])
</head>
<body>
    <header class="detail-header">
        <a href="{{ url('/') }}" class="back-link"><i class="fas fa-arrow-left"></i> Volver al mapa</a>
        <h1>Detalle de Propiedad</h1>
    </header>

    <main class="detail-wrapper">
        <div class="detail-container">
            <section class="image-gallery-section">
                <div class="main-image-container" id="mainImageContainer">
                    <img id="mainImage" src="" alt="Imagen principal" />
                    <button class="image-nav-btn prev-btn" id="prevImageBtn"><i class="fas fa-chevron-left"></i></button>
                    <button class="image-nav-btn next-btn" id="nextImageBtn"><i class="fas fa-chevron-right"></i></button>
                </div>
                <div class="thumbnail-grid" id="thumbnailGrid">
                    </div>
            </section>

            <section class="property-info-section">
                <div class="info-header">
                    <h2 id="propertyTitle">Cargando...</h2>
                    <div class="property-location">
                        <i class="fas fa-map-marker-alt"></i>
                        <span id="propertyNeighborhood">-</span>
                        <span class="location-reference" id="propertyReference">-</span>
                    </div>
                </div>

                <div class="property-details-grid">
                    <div class="detail-item">
                        <i class="fas fa-home"></i>
                        <div>
                            <span class="detail-label">Tipo</span>
                            <span class="detail-value" id="propertyType">-</span>
                        </div>
                    </div>
                    <div class="detail-item">
                        <i class="fas fa-door-open"></i> 
                        <div>
                            <span class="detail-label">Alojamiento</span>
                            <span class="detail-value" id="propertyAccommodation">-</span> 
                        </div>
                    </div>
                    <div class="detail-item">
                        <i class="fas fa-bed"></i>
                        <div>
                            <span class="detail-label">Habitaciones</span>
                            <span class="detail-value" id="propertyRooms">-</span>
                        </div>
                    </div>
                    <div class="detail-item">
                        <i class="fas fa-bath"></i>
                        <div>
                            <span class="detail-label">Baños</span>
                            <span class="detail-value" id="propertyBathrooms">-</span>
                        </div>
                    </div>
                    
                    <div class="detail-item">
                        <i class="fas fa-tree"></i> 
                        <div>
                            <span class="detail-label">Patio/Jardín</span>
                            <span class="detail-value" id="hasPatio">-</span> 
                        </div>
                    </div>
                    <div class="detail-item">
                        <i class="fas fa-car"></i> 
                        <div>
                            <span class="detail-label">Estacionamiento</span>
                            <span class="detail-value" id="hasParking">-</span>
                        </div>
                    </div>
                    <div class="detail-item">
                        <i class="fas fa-couch"></i> 
                        <div>
                            <span class="detail-label">Amueblado</span>
                            <span class="detail-value" id="amueblado">-</span>
                        </div>
                    </div>
                    <div class="detail-item price-item">
                        <i class="fas fa-dollar-sign"></i>
                        <div>
                            <span class="detail-label">Precio</span>
                            <span class="detail-value price-value" id="propertyPrice">-</span>
                        </div>
                    </div>
                </div>

                <div class="description-section">
                    <h3>Descripción</h3>
                    <p id="propertyDescription">-</p>
                </div>

                <div class="services-section">
                    <div class="services-grid">
                        <div class="service-category" id="facilitiesSection">
                            <h3><i class="fas fa-concierge-bell"></i> Instalaciones</h3>
                            <div class="service-list" id="facilitiesList"></div>
                        </div>
                        <div class="service-category" id="roomServicesSection">
                            <h3><i class="fas fa-person-booth"></i> Servicios de la habitación</h3>
                            <div class="service-list" id="roomServicesList"></div>
                        </div>
                        <div class="service-category" id="groupTypesSection">
                            <h3><i class="fas fa-users"></i> Tipo de Grupo</h3>
                            <div class="service-list" id="groupTypesList"></div>
                        </div>
                        <div class="service-category" id="funTypesSection">
                            <h3><i class="fas fa-glass-cheers"></i> Para pasarlo bien</h3>
                            <div class="service-list" id="funTypesList"></div>
                        </div>
                    </div>
                </div>

                <div class="map-section">
                    <h3><i class="fas fa-map"></i> Ubicación</h3>
                    <div id="propertyMap" class="property-map"></div>
                    <div class="coordinates-info">
                        <span>Latitud: <strong id="displayLat">-</strong></span>
                        <span>Longitud: <strong id="displayLng">-</strong></span>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <script>
        // Esta variable global contendrá el ID de la propiedad que estamos viendo
        const PROPERTY_ID = {{ Js::from($propiedad->id ?? null) }};
        // Usamos Js::from() para inyectar la variable de Laravel de forma segura.
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.4.0/leaflet.js"></script>
</body>
</html>