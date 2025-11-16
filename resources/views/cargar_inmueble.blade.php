<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cargar Inmueble - Formosa Capital</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.4.0/leaflet.css" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    @vite(['resources/css/cargar_inmueble.css', 'resources/js/cargar_inmueble.js'])
</head>
<body>
    <header class="publish-header">
        <div class="header-left">
            <a href="{{ url('/') }}" class="back-link"><i class="fas fa-arrow-left"></i> Volver al mapa</a>
        </div>
        <div class="header-center-title">
            <span class="header-title-text">Sube tu propiedad</span>
        </div>
        <div class="header-right" aria-hidden="true"></div>
    </header>

    <main class="publish-wrapper">
        <section class="publish-form-card" id="publishFormCard">
            <h2>Información general</h2>
            <form id="propertyForm" class="publish-form">
                <div class="form-grid">
                    <label>
                        <span>Título de la publicación</span>
                        <input type="text" name="title" placeholder="Ej: Casa familiar con patio" required>
                    </label>
                    <label class="full-width">
                        <span>Tipo de propiedad</span>
                        <select name="accommodationType" id="propertyTypeSelect" required>
                            <option value="">Seleccione un tipo</option>
                        </select>
                    </label>
                    <label>
                        <span>Precio (ARS)</span>
                        <div class="price-period-wrapper">
                            <select name="pricePeriod" id="pricePeriod" class="period-select">
                                <option value="daily">Por día</option>
                                <option value="weekly">Semanal</option>
                                <option value="monthly">Mensual</option>
                            </select>
                            <input type="text" name="price" id="priceInput" placeholder="Ej: 850.000" required>
                        </div>
                    </label>
                    <label>
                        <span>Barrio / Zona</span>
                        <input type="text" name="neighborhood" placeholder="Ej: San Martín" required>
                    </label>
                    <label>
                        <span>Habitaciones</span>
                        <input type="number" name="rooms" min="0" step="1" value="1">
                    </label>
                    <label>
                        <span>Baños</span>
                        <input type="number" name="bathrooms" min="0" step="1" value="1">
                    </label>
                </div>

                <label class="full-width">
                    <span>Descripción detallada</span>
                    <textarea name="description" rows="4" placeholder="Describe la propiedad, servicios cercanos, requisitos, etc." required></textarea>
                </label>

                <label class="full-width">
                    <span>Servicios incluidos</span>
                    <div class="services-wrapper">
                        <textarea name="services" id="servicesText" rows="3" placeholder="Escribe servicios adicionales aquí (ej: Wifi, limpieza semanal, seguridad 24 hs)"></textarea>
                        <button type="button" class="toggle-services-btn" id="toggleServicesBtn">
                            <i class="fas fa-list"></i> Seleccionar de lista
                        </button>
                    </div>
                    <div class="services-checkboxes" id="servicesCheckboxes" style="display: none;">
                        <div class="services-category">
                            <h4>Instalaciones</h4>
                            <label class="checkbox-label"><input type="checkbox" name="facility" value="estacionamiento"> Estacionamiento</label>
                            <label class="checkbox-label"><input type="checkbox" name="facility" value="restaurante"> Restaurante</label>
                            <label class="checkbox-label"><input type="checkbox" name="facility" value="servicio_habitaciones"> Servicio de habitaciones</label>
                            <label class="checkbox-label"><input type="checkbox" name="facility" value="recepcion_24_horas"> Recepción 24 horas</label>
                            <label class="checkbox-label"><input type="checkbox" name="facility" value="gimnasio"> Gimnasio</label>
                            <label class="checkbox-label"><input type="checkbox" name="facility" value="traslado_aeropuerto"> Traslado aeropuerto</label>
                            <label class="checkbox-label"><input type="checkbox" name="facility" value="spa_bienestar"> Spa y centro de bienestar</label>
                            <label class="checkbox-label"><input type="checkbox" name="facility" value="banera_hidromasaje"> Bañera hidromasaje</label>
                            <label class="checkbox-label"><input type="checkbox" name="facility" value="jacuzzi"> Jacuzzi</label>
                            <label class="checkbox-label"><input type="checkbox" name="facility" value="wifi_gratis"> Wifi Gratis</label>
                            <label class="checkbox-label"><input type="checkbox" name="facility" value="estacion_carga_vehiculos_electricos"> Estación de carga de vehículos eléctricos</label>
                            <label class="checkbox-label"><input type="checkbox" name="facility" value="adaptado_sillas_ruedas"> Adaptado para sillas de ruedas</label>
                        </div>
                        <div class="services-category">
                            <h4>Servicios de la habitación</h4>
                            <label class="checkbox-label"><input type="checkbox" name="roomService" value="bano_privado"> Baño privado</label>
                            <label class="checkbox-label"><input type="checkbox" name="roomService" value="piscina_privada"> Piscina privada</label>
                            <label class="checkbox-label"><input type="checkbox" name="roomService" value="balcon"> Balcón</label>
                            <label class="checkbox-label"><input type="checkbox" name="roomService" value="aire_acondicionado"> Aire acondicionado</label>
                            <label class="checkbox-label"><input type="checkbox" name="roomService" value="cocina"> Cocina</label>
                            <label class="checkbox-label"><input type="checkbox" name="roomService" value="banera_hidromasaje_habitacion"> Bañera de hidromasaje</label>
                            <label class="checkbox-label"><input type="checkbox" name="roomService" value="vistas"> Vistas</label>
                            <label class="checkbox-label"><input type="checkbox" name="roomService" value="banera"> Bañera</label>
                            <label class="checkbox-label"><input type="checkbox" name="roomService" value="sauna"> Sauna</label>
                            <label class="checkbox-label"><input type="checkbox" name="roomService" value="chimenea"> Chimenea</label>
                            <label class="checkbox-label"><input type="checkbox" name="roomService" value="vistas_montana"> Vistas a la montaña</label>
                            <label class="checkbox-label"><input type="checkbox" name="roomService" value="acceso_ascensor"> Acceso a pisos superiores en ascensor</label>
                            <label class="checkbox-label"><input type="checkbox" name="roomService" value="tv_pantalla_plana"> TV de pantalla plana</label>
                        </div>
                        <div class="services-category">
                            <h4>Tipo de Grupo</h4>
                            <label class="checkbox-label"><input type="checkbox" name="groupType" value="admite_mascotas"> Admite mascotas</label>
                            <label class="checkbox-label"><input type="checkbox" name="groupType" value="solo_adultos"> Solo para adultos</label>
                        </div>
                        <div class="services-category">
                            <h4>Para pasarlo bien</h4>
                            <label class="checkbox-label"><input type="checkbox" name="funType" value="piscina"> Piscina</label>
                            <label class="checkbox-label"><input type="checkbox" name="funType" value="sala_juegos"> Sala de juegos</label>
                            <label class="checkbox-label"><input type="checkbox" name="funType" value="cine"> Cine</label>
                        </div>
                    </div>
                </label>

                <label class="full-width">
                    <span>Ubicación en el mapa</span>
                    <p class="helper-text">Haz clic en el mapa para marcar la ubicación de tu propiedad. Puedes arrastrar el marcador para ajustar la posición.</p>
                    <div id="locationMap" class="location-map"></div>
                    <div class="coordinates-display">
                        <span>Latitud: <strong id="displayLat">-</strong></span>
                        <span>Longitud: <strong id="displayLng">-</strong></span>
                        <button type="button" id="centerMapBtn" class="center-map-btn"><i class="fas fa-crosshairs"></i> Centrar en Formosa</button>
                    </div>
                    <input type="hidden" name="lat" id="hiddenLat" required>
                    <input type="hidden" name="lng" id="hiddenLng" required>
                </label>

                <h2>Galería de imágenes</h2>
                <p class="helper-text">Puedes subir hasta 10 imágenes en formato JPG o PNG (máx. 3MB cada una). La primera imagen será la portada.</p>
                <div class="image-slots-grid" id="imageSlotsGrid">

                </div>

                <div class="form-actions">
                    <button type="submit" class="primary-btn"><i class="fas fa-paper-plane"></i> Enviar publicación</button>
                    <button type="button" id="saveDraftBtn" class="secondary-btn"><i class="fas fa-save"></i> Guardar borrador</button>
                </div>
            </form>
        </section>
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.4.0/leaflet.js"></script>
</body>
</html>
