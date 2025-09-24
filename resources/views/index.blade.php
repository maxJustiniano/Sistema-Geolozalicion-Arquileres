<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mapa de Propiedades - Formosa Capital</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.4.0/leaflet.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header id="header">
        <div class="logo"><i class="fas fa-home"></i> Propiedades Formosa</div>
        <div class="subtitle">Encuentra tu hogar ideal en la capital</div>
        <div class="header-actions">
            <button id="toggleFiltersBtn" class="header-btn"><i class="fas fa-filter"></i> Filtros</button>
            <button id="loginBtn" class="header-btn"><i class="fas fa-user"></i> Iniciar Sesión</button>
        </div>
    </header>

    <div id="sidebar">
        <h2><i class="fas fa-filter"></i> Filtros Avanzados</h2>
        
        <div class="filter-card">
            <div class="filter-group">
                <label><i class="fas fa-home"></i> Tipo de Propiedad:</label>
                <select id="propertyType">
                    <option value="">Todas</option>
                    <option value="casa">Casa</option>
                    <option value="departamento">Departamento</option>
                    <option value="terreno">Terreno</option>
                    <option value="ph">PH</option>
                </select>
            </div>

            <div class="filter-group">
                <label><i class="fas fa-map-marker-alt"></i> Barrio:</label>
                <input type="text" id="neighborhood" placeholder="Ej: Centro, San Martín...">
            </div>

            <div class="filter-group">
                <label><i class="fas fa-bed"></i> Habitaciones (mín):</label>
                <input type="number" id="minRooms" min="0" max="10" value="0">
            </div>
            <div class="filter-group">
                <label><i class="fas fa-bath"></i> Baños (mín):</label>
                <input type="number" id="minBathrooms" min="0" max="5" value="0">
            </div>
        </div>

        <div class="filter-card">
            <div class="filter-group">
                <label><i class="fas fa-dollar-sign"></i> Rango de Precios (ARS):</label>
                <div class="slider-container">
                    <input type="range" id="minPrice" min="3000000" max="12000000" value="3000000" class="price-slider">
                    <input type="range" id="maxPrice" min="3000000" max="12000000" value="12000000" class="price-slider">
                    <div id="priceRangeDisplay">3.000.000 - 12.000.000 ARS</div>
                </div>
            </div>
        </div>

        <div class="filter-card">
            <div class="filter-group">
                <label><i class="fas fa-star"></i> Amenidades:</label>
                <label class="checkbox-label"><input type="checkbox" id="hasPatio"> <i class="fas fa-tree"></i> Patio</label>
                <label class="checkbox-label"><input type="checkbox" id="hasAmueblado"> <i class="fas fa-couch"></i> Amueblado</label>
                <label class="checkbox-label"><input type="checkbox" id="hasParking"> <i class="fas fa-car"></i> Estacionamiento</label>
                <label class="checkbox-label"><input type="checkbox" id="hasPool"> <i class="fas fa-swimming-pool"></i> Pileta</label>
                <label class="checkbox-label"><input type="checkbox" id="petsAllowed"> <i class="fas fa-paw"></i> Admite Mascotas</label>
            </div>
        </div>

        <div class="filter-card">
            <div class="filter-group">
                <label><i class="fas fa-landmark"></i> Lugares de Referencia:</label>
                <input type="text" id="referencePlace" placeholder="Ej: cerca de Plaza San Martín...">
            </div>
        </div>

        <div class="button-group">
            <button id="applyFilters" class="apply-btn"><i class="fas fa-search"></i> Aplicar Filtros</button>
            <button id="clearFilters" class="clear-btn"><i class="fas fa-times"></i> Limpiar</button>
        </div>
    </div>

    <button id="toggleSidebar" class="toggle-btn"><i class="fas fa-bars"></i></button>

    <div id="map"></div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.4.0/leaflet.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.0.min.js"></script>
    <script src="map.js"></script>
</body>
</html>