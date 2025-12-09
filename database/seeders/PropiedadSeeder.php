<?php

namespace Database\Seeders;

use App\Models\Filtro;
use App\Models\Propiedad;
use App\Models\TipoEstancia;
use App\Models\TipoPropiedad;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PropiedadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Obtener el ID del rol de 'propietario'
        $propietarioRole = DB::table('roles')->where('nombre_rol', 'propietario')->first();

        if (!$propietarioRole) {
            throw new \Exception("El rol 'propietario' no se encontró. Asegúrate de que RolesUserSeeder se haya ejecutado y el nombre coincida.");
        }
        $propietarioRoleId = $propietarioRole->id;

        // 2. Crear un usuario dummy si no existe
        $user = User::firstOrCreate(
            ['email' => 'dummy@geolocalizacion.com'], 
            [
                'id_rol' => $propietarioRoleId,
                'name' => 'Usuario Demo',
                'password' => bcrypt('password'),
                'nombre_persona' => 'Demo', 
                'apellido_persona' => 'Propietario',
            ]
        );
        $dummyUserId = $user->id;

        // 3. Cargar Lookups en memoria para un mapeo rápido
        $tiposPropiedad = TipoPropiedad::all()->keyBy('slug');
        $tiposEstancia = TipoEstancia::all()->keyBy('slug');
        $filtros = Filtro::all()->keyBy('slug');

        // 4. Datos de muestra EXPANDIDOS (60 Propiedades)
        $sampleProperties = [
            // ** BLOQUE 1: PROPIEDADES INICIALES (1-30) **
            [ 'type' => 'casa', 'accommodationType' => 'casa_chalet', 'neighborhood' => 'Centro', 'rooms' => 5, 'bathrooms' => 4, 'price' => 20000000, 'hasPatio' => true, 'hasAmueblado' => true, 'hasParking' => true, 'lat' => -26.1773, 'lng' => -58.1810, 'reference' => 'Casa exclusiva con piscina', 'description' => 'Casa acogedora en el corazón de Formosa, cerca de la plaza.', 'filters_slugs' => ['estacionamiento', 'wifi_gratis', 'piscina', 'jacuzzi', 'spa_bienestar', 'piscina_privada', 'balcon', 'aire_acondicionado', 'cocina', 'banera_hidromasaje_habitacion', 'sauna', 'chimenea', 'vistas', 'sala_juegos', 'cine', 'admite_mascotas'] ],
            [ 'type' => 'departamento', 'accommodationType' => 'apartamento', 'neighborhood' => 'San Martín', 'rooms' => 2, 'bathrooms' => 1, 'price' => 6500000, 'hasPatio' => false, 'hasAmueblado' => true, 'hasParking' => false, 'lat' => -26.1800, 'lng' => -58.1780, 'reference' => 'Cerca de la Costanera', 'description' => 'Depto espacioso con balcón, ideal para parejas.', 'filters_slugs' => ['recepcion_24_horas', 'gimnasio', 'acceso_ascensor', 'tv_pantalla_plana', 'wifi_gratis', 'balcon'] ],
            [ 'type' => 'ph', 'accommodationType' => 'habitacion_particular', 'neighborhood' => 'La Esmeralda', 'rooms' => 1, 'bathrooms' => 1, 'price' => 3500000, 'hasPatio' => true, 'hasAmueblado' => true, 'hasParking' => true, 'lat' => -26.1820, 'lng' => -58.1680, 'reference' => 'Cerca de Parque Libertad', 'description' => 'PH luminoso y renovado con servicios incluidos.', 'filters_slugs' => ['restaurante', 'servicio_habitaciones', 'bano_privado', 'cocina', 'banera', 'solo_adultos'] ],
            [ 'type' => 'casa', 'accommodationType' => 'villa', 'neighborhood' => 'La Pilar', 'rooms' => 3, 'bathrooms' => 2, 'price' => 14500000, 'hasPatio' => true, 'hasAmueblado' => false, 'hasParking' => true, 'lat' => -26.1656, 'lng' => -58.1965, 'reference' => 'Zona residencial tranquila', 'description' => 'Villa amplia, ideal para personas con movilidad reducida y piscina.', 'filters_slugs' => ['estacion_carga_vehiculos_electricos', 'adaptado_sillas_ruedas', 'piscina', 'jacuzzi'] ],
            [ 'type' => 'casa', 'accommodationType' => 'hotel', 'neighborhood' => 'Centro', 'rooms' => 2, 'bathrooms' => 1, 'price' => 7800000, 'hasPatio' => false, 'hasAmueblado' => true, 'hasParking' => true, 'lat' => -26.1850, 'lng' => -58.1750, 'reference' => 'Hotel céntrico y cómodo', 'description' => 'Suite de hotel con vistas, ideal para viajes de negocios.', 'filters_slugs' => ['restaurante', 'servicio_habitaciones', 'traslado_aeropuerto', 'vistas', 'wifi_gratis', 'tv_pantalla_plana'] ],
            [ 'type' => 'terreno', 'accommodationType' => 'alquiler', 'neighborhood' => 'Guadalupe', 'rooms' => 0, 'bathrooms' => 0, 'price' => 3000000, 'hasPatio' => false, 'hasAmueblado' => false, 'hasParking' => false, 'lat' => -26.1700, 'lng' => -58.1900, 'reference' => 'Terreno ideal para construir.', 'description' => 'Cerca de Iglesia Guadalupe, buena ubicación.', 'filters_slugs' => [] ],
            [ 'type' => 'casa', 'accommodationType' => 'albergue', 'neighborhood' => 'Eva Perón', 'rooms' => 6, 'bathrooms' => 5, 'price' => 4000000, 'hasPatio' => true, 'hasAmueblado' => false, 'hasParking' => false, 'lat' => -26.1885, 'lng' => -58.1672, 'reference' => 'Albergue cerca de la universidad', 'description' => 'Camas compartidas con amplios baños y patio.', 'filters_slugs' => ['wifi_gratis', 'adaptado_sillas_ruedas', 'admite_mascotas'] ],
            [ 'type' => 'casa', 'accommodationType' => 'cabana', 'neighborhood' => 'Las Delicias', 'rooms' => 2, 'bathrooms' => 1, 'price' => 7000000, 'hasPatio' => true, 'hasAmueblado' => true, 'hasParking' => true, 'lat' => -26.1600, 'lng' => -58.1950, 'reference' => 'Cabaña en zona arbolada', 'description' => 'Ideal para el descanso con chimenea y vistas a la montaña.', 'filters_slugs' => ['estacionamiento', 'chimenea', 'vistas_montana', 'admite_mascotas'] ],
            [ 'type' => 'casa', 'accommodationType' => 'residencial', 'neighborhood' => 'Norte', 'rooms' => 4, 'bathrooms' => 3, 'price' => 11000000, 'hasPatio' => true, 'hasAmueblado' => true, 'hasParking' => true, 'lat' => -26.1650, 'lng' => -58.1820, 'reference' => 'Residencial con seguridad y amenities', 'description' => 'Unidad con piscina propia y grandes espacios.', 'filters_slugs' => ['piscina', 'piscina_privada', 'gimnasio', 'jacuzzi', 'tv_pantalla_plana', 'bano_privado'] ],
            [ 'type' => 'terreno', 'accommodationType' => 'camping', 'neighborhood' => 'Río Bermejo', 'rooms' => 0, 'bathrooms' => 0, 'price' => 2000000, 'hasPatio' => true, 'hasAmueblado' => false, 'hasParking' => false, 'lat' => -26.1500, 'lng' => -58.1500, 'reference' => 'Zona de acampe cerca del río', 'description' => 'Parcela para carpas o motorhome, se admiten mascotas.', 'filters_slugs' => ['estacionamiento', 'admite_mascotas'] ],
            [ 'type' => 'departamento', 'accommodationType' => 'apartamento', 'neighborhood' => 'Centro', 'rooms' => 3, 'bathrooms' => 2, 'price' => 9500000, 'hasPatio' => false, 'hasAmueblado' => true, 'hasParking' => true, 'lat' => -26.1830, 'lng' => -58.1750, 'reference' => 'Departamento de categoría con cochera', 'description' => 'Excelente ubicación céntrica, acabados de calidad.', 'filters_slugs' => ['estacionamiento', 'wifi_gratis', 'acceso_ascensor', 'aire_acondicionado'] ],
            [ 'type' => 'casa', 'accommodationType' => 'casa_chalet', 'neighborhood' => 'San Juan', 'rooms' => 4, 'bathrooms' => 3, 'price' => 15000000, 'hasPatio' => true, 'hasAmueblado' => false, 'hasParking' => true, 'lat' => -26.1950, 'lng' => -58.1880, 'reference' => 'Chalet moderno con 4 habitaciones', 'description' => 'Amplio chalet con jardín y quincho.', 'filters_slugs' => ['estacionamiento', 'piscina', 'cocina', 'chimenea', 'sala_juegos'] ],
            [ 'type' => 'ph', 'accommodationType' => 'habitacion_particular', 'neighborhood' => 'Villa Hermosa', 'rooms' => 1, 'bathrooms' => 1, 'price' => 4200000, 'hasPatio' => false, 'hasAmueblado' => true, 'hasParking' => false, 'lat' => -26.1730, 'lng' => -58.1650, 'reference' => 'Habitación privada con baño propio', 'description' => 'Ideal para estudiantes, amueblada.', 'filters_slugs' => ['wifi_gratis', 'bano_privado'] ],
            [ 'type' => 'departamento', 'accommodationType' => 'hotel', 'neighborhood' => 'Costanera', 'rooms' => 1, 'bathrooms' => 1, 'price' => 5500000, 'hasPatio' => false, 'hasAmueblado' => true, 'hasParking' => false, 'lat' => -26.1705, 'lng' => -58.1770, 'reference' => 'Monoambiente frente al río', 'description' => 'Vistas directas a la Costanera de Formosa.', 'filters_slugs' => ['restaurante', 'recepcion_24_horas', 'vistas', 'balcon', 'solo_adultos'] ],
            [ 'type' => 'terreno', 'accommodationType' => 'alquiler', 'neighborhood' => 'Virgen del Carmen', 'rooms' => 0, 'bathrooms' => 0, 'price' => 3600000, 'hasPatio' => false, 'hasAmueblado' => false, 'hasParking' => false, 'lat' => -26.1959, 'lng' => -58.1705, 'reference' => 'Terreno nivelado cerca de la ruta', 'description' => 'Excelente para depósito o pequeña construcción.', 'filters_slugs' => [] ],
            [ 'type' => 'casa', 'accommodationType' => 'cabana', 'neighborhood' => 'Timbó', 'rooms' => 3, 'bathrooms' => 2, 'price' => 8500000, 'hasPatio' => true, 'hasAmueblado' => true, 'hasParking' => true, 'lat' => -26.1550, 'lng' => -58.1650, 'reference' => 'Cabaña con deck y vistas al río', 'description' => 'Tranquilidad total, ideal para fines de semana.', 'filters_slugs' => ['estacionamiento', 'vistas', 'chimenea', 'admite_mascotas'] ],
            [ 'type' => 'departamento', 'accommodationType' => 'apartamento', 'neighborhood' => 'Centro', 'rooms' => 1, 'bathrooms' => 1, 'price' => 5000000, 'hasPatio' => false, 'hasAmueblado' => true, 'hasParking' => false, 'lat' => -26.1825, 'lng' => -58.1805, 'reference' => 'Departamento a estrenar', 'description' => 'Moderno y bien ubicado, cerca de todo.', 'filters_slugs' => ['acceso_ascensor', 'wifi_gratis', 'tv_pantalla_plana'] ],
            [ 'type' => 'casa', 'accommodationType' => 'casa_chalet', 'neighborhood' => 'Villa Hermosa', 'rooms' => 5, 'bathrooms' => 4, 'price' => 18000000, 'hasPatio' => true, 'hasAmueblado' => false, 'hasParking' => true, 'lat' => -26.1740, 'lng' => -58.1920, 'reference' => 'Chalet con 5 habitaciones y garaje doble', 'description' => 'Casa de grandes dimensiones para familia numerosa.', 'filters_slugs' => ['estacionamiento', 'cocina', 'bano_privado', 'adaptado_sillas_ruedas'] ],
            [ 'type' => 'terreno', 'accommodationType' => 'alquiler', 'neighborhood' => 'Eva Perón', 'rooms' => 0, 'bathrooms' => 0, 'price' => 2500000, 'hasPatio' => false, 'hasAmueblado' => false, 'hasParking' => false, 'lat' => -26.1905, 'lng' => -58.1690, 'reference' => 'Terreno económico en la zona sur', 'description' => 'Ideal para inversión, rápida salida a ruta.', 'filters_slugs' => [] ],
            [ 'type' => 'departamento', 'accommodationType' => 'hotel', 'neighborhood' => 'Costanera', 'rooms' => 2, 'bathrooms' => 2, 'price' => 10500000, 'hasPatio' => false, 'hasAmueblado' => true, 'hasParking' => true, 'lat' => -26.1790, 'lng' => -58.1795, 'reference' => 'Suite de lujo con jacuzzi', 'description' => 'Servicio de habitaciones 24h, vistas panorámicas.', 'filters_slugs' => ['restaurante', 'servicio_habitaciones', 'jacuzzi', 'banera_hidromasaje_habitacion', 'traslado_aeropuerto'] ],
            [ 'type' => 'casa', 'accommodationType' => 'villa', 'neighborhood' => 'La Pilar', 'rooms' => 4, 'bathrooms' => 3, 'price' => 16000000, 'hasPatio' => true, 'hasAmueblado' => true, 'hasParking' => true, 'lat' => -26.1645, 'lng' => -58.1970, 'reference' => 'Villa amueblada con pileta climatizada', 'description' => 'Espacio exterior espectacular con zona de cine.', 'filters_slugs' => ['piscina_privada', 'gimnasio', 'sauna', 'cine', 'sala_juegos', 'aire_acondicionado'] ],
            [ 'type' => 'ph', 'accommodationType' => 'habitacion_particular', 'neighborhood' => 'Centro', 'rooms' => 1, 'bathrooms' => 1, 'price' => 3000000, 'hasPatio' => false, 'hasAmueblado' => true, 'hasParking' => false, 'lat' => -26.1835, 'lng' => -58.1820, 'reference' => 'Habitación económica y central', 'description' => 'Cerca de paradas de colectivo y comercios.', 'filters_slugs' => ['wifi_gratis'] ],
            [ 'type' => 'casa', 'accommodationType' => 'casa_chalet', 'neighborhood' => 'San Juan', 'rooms' => 3, 'bathrooms' => 2, 'price' => 9800000, 'hasPatio' => true, 'hasAmueblado' => true, 'hasParking' => true, 'lat' => -26.1940, 'lng' => -58.1890, 'reference' => 'Casa con patio grande para mascotas', 'description' => 'Barrio tranquilo, ideal para familias con animales.', 'filters_slugs' => ['admite_mascotas', 'estacionamiento', 'cocina', 'tiene_patio'] ],
            [ 'type' => 'departamento', 'accommodationType' => 'apartamento', 'neighborhood' => 'Norte', 'rooms' => 2, 'bathrooms' => 1, 'price' => 7000000, 'hasPatio' => false, 'hasAmueblado' => false, 'hasParking' => true, 'lat' => -26.1630, 'lng' => -58.1810, 'reference' => 'Departamento con acceso directo a ruta 11', 'description' => 'Zona en crecimiento, buena inversión.', 'filters_slugs' => ['estacionamiento', 'acceso_ascensor'] ],
            [ 'type' => 'casa', 'accommodationType' => 'residencial', 'neighborhood' => 'Guadalupe', 'rooms' => 5, 'bathrooms' => 4, 'price' => 13500000, 'hasPatio' => true, 'hasAmueblado' => true, 'hasParking' => true, 'lat' => -26.1710, 'lng' => -58.1920, 'reference' => 'Residencial moderno con grandes ventanales', 'description' => 'Mucha luz natural y excelente seguridad.', 'filters_slugs' => ['piscina', 'gimnasio', 'recepcion_24_horas', 'cocina'] ],
            [ 'type' => 'terreno', 'accommodationType' => 'camping', 'neighborhood' => 'Río Bermejo', 'rooms' => 0, 'bathrooms' => 0, 'price' => 1500000, 'hasPatio' => true, 'hasAmueblado' => false, 'hasParking' => false, 'lat' => -26.1510, 'lng' => -58.1510, 'reference' => 'Camping en la costa del río', 'description' => 'Sector delimitado y servicio de vigilancia.', 'filters_slugs' => ['estacionamiento'] ],
            [ 'type' => 'casa', 'accommodationType' => 'albergue', 'neighborhood' => 'Eva Perón', 'rooms' => 8, 'bathrooms' => 6, 'price' => 5000000, 'hasPatio' => true, 'hasAmueblado' => false, 'hasParking' => false, 'lat' => -26.1895, 'lng' => -58.1682, 'reference' => 'Albergue con alta capacidad', 'description' => 'Ideal para grupos grandes o mochileros.', 'filters_slugs' => ['wifi_gratis', 'adaptado_sillas_ruedas', 'admite_mascotas', 'cocina'] ],
            [ 'type' => 'casa', 'accommodationType' => 'cabana', 'neighborhood' => 'Las Delicias', 'rooms' => 2, 'bathrooms' => 2, 'price' => 9000000, 'hasPatio' => true, 'hasAmueblado' => true, 'hasParking' => true, 'lat' => -26.1610, 'lng' => -58.1960, 'reference' => 'Cabaña de lujo con piscina privada', 'description' => 'Piscina y deck, vistas espectaculares.', 'filters_slugs' => ['piscina_privada', 'jacuzzi', 'sauna', 'chimenea', 'vistas_montana', 'solo_adultos'] ],
            [ 'type' => 'departamento', 'accommodationType' => 'hotel', 'neighborhood' => 'Costanera', 'rooms' => 1, 'bathrooms' => 1, 'price' => 6800000, 'hasPatio' => false, 'hasAmueblado' => true, 'hasParking' => true, 'lat' => -26.1785, 'lng' => -58.1775, 'reference' => 'Apart hotel con servicios incluidos', 'description' => 'Limpieza diaria y desayuno incluido.', 'filters_slugs' => ['restaurante', 'servicio_habitaciones', 'gimnasio', 'traslado_aeropuerto', 'wifi_gratis'] ],
            [ 'type' => 'ph', 'accommodationType' => 'habitacion_particular', 'neighborhood' => 'Villa Hermosa', 'rooms' => 2, 'bathrooms' => 1, 'price' => 4800000, 'hasPatio' => true, 'hasAmueblado' => true, 'hasParking' => false, 'lat' => -26.1720, 'lng' => -58.1640, 'reference' => 'Dos habitaciones en PH con patio', 'description' => 'Espacio compartido tranquilo y seguro.', 'filters_slugs' => ['bano_privado', 'cocina', 'admite_mascotas'] ],

            // ** BLOQUE 2: 30 PROPIEDADES NUEVAS (31-60) **
            [ 'type' => 'departamento', 'accommodationType' => 'apartamento', 'neighborhood' => 'Microcentro', 'rooms' => 1, 'bathrooms' => 1, 'price' => 4500000, 'hasPatio' => false, 'hasAmueblado' => true, 'hasParking' => false, 'lat' => -26.1850, 'lng' => -58.1820, 'reference' => 'Monoambiente en zona de bancos', 'description' => 'Ideal para profesionales, fácil acceso al centro.', 'filters_slugs' => ['wifi_gratis', 'acceso_ascensor', 'tv_pantalla_plana'] ],
            [ 'type' => 'casa', 'accommodationType' => 'casa_chalet', 'neighborhood' => 'Villa del Carmen', 'rooms' => 4, 'bathrooms' => 2, 'price' => 11000000, 'hasPatio' => true, 'hasAmueblado' => false, 'hasParking' => true, 'lat' => -26.1980, 'lng' => -58.1600, 'reference' => 'Chalet familiar con gran patio', 'description' => 'Ubicación tranquila y segura, cerca de colegios.', 'filters_slugs' => ['estacionamiento', 'admite_mascotas', 'cocina'] ],
            [ 'type' => 'ph', 'accommodationType' => 'habitacion_particular', 'neighborhood' => 'Centro', 'rooms' => 1, 'bathrooms' => 1, 'price' => 3800000, 'hasPatio' => false, 'hasAmueblado' => true, 'hasParking' => false, 'lat' => -26.1810, 'lng' => -58.1830, 'reference' => 'Habitación con entrada independiente', 'description' => 'Espacio solo para adultos, cerca de bares.', 'filters_slugs' => ['bano_privado', 'servicio_habitaciones', 'solo_adultos'] ],
            [ 'type' => 'casa', 'accommodationType' => 'villa', 'neighborhood' => 'San Miguel', 'rooms' => 5, 'bathrooms' => 5, 'price' => 25000000, 'hasPatio' => true, 'hasAmueblado' => true, 'hasParking' => true, 'lat' => -26.1700, 'lng' => -58.2000, 'reference' => 'Mansión con todas las comodidades', 'description' => 'Lujo extremo: piscina, spa, gimnasio, cine.', 'filters_slugs' => ['piscina_privada', 'spa_bienestar', 'sauna', 'cine', 'gimnasio', 'banera_hidromasaje_habitacion'] ],
            [ 'type' => 'terreno', 'accommodationType' => 'alquiler', 'neighborhood' => 'La Floresta', 'rooms' => 0, 'bathrooms' => 0, 'price' => 2800000, 'hasPatio' => false, 'hasAmueblado' => false, 'hasParking' => false, 'lat' => -26.1600, 'lng' => -58.1850, 'reference' => 'Lote en zona de desarrollo', 'description' => 'Terreno limpio listo para urbanizar.', 'filters_slugs' => [] ],
            [ 'type' => 'casa', 'accommodationType' => 'hotel', 'neighborhood' => 'Costanera', 'rooms' => 2, 'bathrooms' => 2, 'price' => 9000000, 'hasPatio' => false, 'hasAmueblado' => true, 'hasParking' => true, 'lat' => -26.1750, 'lng' => -58.1790, 'reference' => 'Habitación de hotel con vistas y jacuzzi', 'description' => 'Servicio de traslado y recepción 24 horas.', 'filters_slugs' => ['restaurante', 'traslado_aeropuerto', 'recepcion_24_horas', 'jacuzzi', 'tv_pantalla_plana'] ],
            [ 'type' => 'departamento', 'accommodationType' => 'albergue', 'neighborhood' => 'El Pucú', 'rooms' => 7, 'bathrooms' => 6, 'price' => 4200000, 'hasPatio' => true, 'hasAmueblado' => false, 'hasParking' => false, 'lat' => -26.1900, 'lng' => -58.1550, 'reference' => 'Albergue con accesibilidad total', 'description' => 'Adaptado para sillas de ruedas, WiFi incluido.', 'filters_slugs' => ['wifi_gratis', 'adaptado_sillas_ruedas'] ],
            [ 'type' => 'casa', 'accommodationType' => 'cabana', 'neighborhood' => 'Puerto Pilcomayo', 'rooms' => 3, 'bathrooms' => 2, 'price' => 10000000, 'hasPatio' => true, 'hasAmueblado' => true, 'hasParking' => true, 'lat' => -26.1400, 'lng' => -58.1900, 'reference' => 'Cabaña de montaña con piscina', 'description' => 'Vistas hermosas, chimenea y permitido para mascotas.', 'filters_slugs' => ['chimenea', 'vistas_montana', 'piscina', 'admite_mascotas', 'estacionamiento'] ],
            [ 'type' => 'casa', 'accommodationType' => 'residencial', 'neighborhood' => 'San Francisco', 'rooms' => 4, 'bathrooms' => 3, 'price' => 12500000, 'hasPatio' => true, 'hasAmueblado' => true, 'hasParking' => true, 'lat' => -26.1680, 'lng' => -58.1880, 'reference' => 'Residencial moderno con cargador EV', 'description' => 'Ideal para familias con vehículos eléctricos.', 'filters_slugs' => ['piscina', 'gimnasio', 'estacion_carga_vehiculos_electricos', 'bano_privado', 'aire_acondicionado'] ],
            [ 'type' => 'terreno', 'accommodationType' => 'camping', 'neighborhood' => 'Herradura', 'rooms' => 0, 'bathrooms' => 0, 'price' => 2200000, 'hasPatio' => true, 'hasAmueblado' => false, 'hasParking' => false, 'lat' => -26.1450, 'lng' => -58.1600, 'reference' => 'Sitio de camping con parrilla', 'description' => 'Espacio para acampar o motorhome, admite mascotas.', 'filters_slugs' => ['admite_mascotas', 'estacionamiento'] ],
            [ 'type' => 'departamento', 'accommodationType' => 'apartamento', 'neighborhood' => 'Centro', 'rooms' => 2, 'bathrooms' => 1, 'price' => 7500000, 'hasPatio' => false, 'hasAmueblado' => true, 'hasParking' => false, 'lat' => -26.1820, 'lng' => -58.1760, 'reference' => 'Departamento amueblado con balcón', 'description' => 'Aire acondicionado y baño privado, muy luminoso.', 'filters_slugs' => ['balcon', 'aire_acondicionado', 'bano_privado', 'wifi_gratis'] ],
            [ 'type' => 'casa', 'accommodationType' => 'casa_chalet', 'neighborhood' => 'Villa Jardín', 'rooms' => 6, 'bathrooms' => 4, 'price' => 22000000, 'hasPatio' => true, 'hasAmueblado' => true, 'hasParking' => true, 'lat' => -26.1790, 'lng' => -58.2050, 'reference' => 'Casa de 6 habitaciones con área de ocio', 'description' => 'Piscina privada, sala de juegos y cine en casa.', 'filters_slugs' => ['piscina_privada', 'sala_juegos', 'cine', 'sauna', 'estacionamiento', 'piscina'] ],
            [ 'type' => 'ph', 'accommodationType' => 'habitacion_particular', 'neighborhood' => 'El Colorado', 'rooms' => 1, 'bathrooms' => 1, 'price' => 3200000, 'hasPatio' => false, 'hasAmueblado' => true, 'hasParking' => false, 'lat' => -26.1880, 'lng' => -58.1720, 'reference' => 'Habitación con vista a la ciudad', 'description' => 'Cocina compartida y excelente vista.', 'filters_slugs' => ['cocina', 'vistas'] ],
            [ 'type' => 'departamento', 'accommodationType' => 'hotel', 'neighborhood' => 'Las Lomitas', 'rooms' => 1, 'bathrooms' => 1, 'price' => 5800000, 'hasPatio' => false, 'hasAmueblado' => true, 'hasParking' => false, 'lat' => -26.1765, 'lng' => -58.1785, 'reference' => 'Suite de hotel cerca de la Costanera', 'description' => 'Incluye desayuno y wifi, recepción 24h.', 'filters_slugs' => ['restaurante', 'recepcion_24_horas', 'wifi_gratis'] ],
            [ 'type' => 'terreno', 'accommodationType' => 'alquiler', 'neighborhood' => '25 de Mayo', 'rooms' => 0, 'bathrooms' => 0, 'price' => 3900000, 'hasPatio' => false, 'hasAmueblado' => false, 'hasParking' => false, 'lat' => -26.1920, 'lng' => -58.1870, 'reference' => 'Terreno de inversión con potencial', 'description' => 'Lote amplio en barrio consolidado.', 'filters_slugs' => [] ],
            [ 'type' => 'casa', 'accommodationType' => 'cabana', 'neighborhood' => 'Riacho Negro', 'rooms' => 2, 'bathrooms' => 1, 'price' => 8000000, 'hasPatio' => true, 'hasAmueblado' => true, 'hasParking' => true, 'lat' => -26.1580, 'lng' => -58.1980, 'reference' => 'Cabaña rústica con vistas a la montaña', 'description' => 'Ambiente cálido con chimenea, ideal para pareja.', 'filters_slugs' => ['chimenea', 'vistas_montana', 'admite_mascotas', 'estacionamiento'] ],
            [ 'type' => 'departamento', 'accommodationType' => 'apartamento', 'neighborhood' => 'La Paz', 'rooms' => 3, 'bathrooms' => 2, 'price' => 8500000, 'hasPatio' => false, 'hasAmueblado' => false, 'hasParking' => true, 'lat' => -26.1950, 'lng' => -58.1750, 'reference' => 'Departamento con cochera y aire central', 'description' => 'Unidad moderna con seguridad 24h.', 'filters_slugs' => ['estacionamiento', 'acceso_ascensor', 'aire_acondicionado', 'gimnasio'] ],
            [ 'type' => 'casa', 'accommodationType' => 'villa', 'neighborhood' => 'Santa Rosa', 'rooms' => 5, 'bathrooms' => 4, 'price' => 19000000, 'hasPatio' => true, 'hasAmueblado' => true, 'hasParking' => true, 'lat' => -26.1620, 'lng' => -58.1700, 'reference' => 'Villa de lujo solo para adultos', 'description' => 'Incluye piscina, jacuzzi y centro de bienestar.', 'filters_slugs' => ['piscina', 'jacuzzi', 'spa_bienestar', 'solo_adultos', 'piscina_privada'] ],
            [ 'type' => 'ph', 'accommodationType' => 'habitacion_particular', 'neighborhood' => 'El Resguardo', 'rooms' => 1, 'bathrooms' => 1, 'price' => 2900000, 'hasPatio' => false, 'hasAmueblado' => false, 'hasParking' => false, 'lat' => -26.1840, 'lng' => -58.1660, 'reference' => 'Habitación básica en zona tranquila', 'description' => 'Espacio con baño compartido.', 'filters_slugs' => ['bano_privado'] ],
            [ 'type' => 'terreno', 'accommodationType' => 'camping', 'neighborhood' => 'Río Salado', 'rooms' => 0, 'bathrooms' => 0, 'price' => 1800000, 'hasPatio' => true, 'hasAmueblado' => false, 'hasParking' => false, 'lat' => -26.1480, 'lng' => -58.1550, 'reference' => 'Camping cerca del río Salado', 'description' => 'Ideal para pesca y actividades al aire libre.', 'filters_slugs' => ['admite_mascotas', 'tiene_patio'] ],
            [ 'type' => 'casa', 'accommodationType' => 'casa_chalet', 'neighborhood' => 'Centro', 'rooms' => 3, 'bathrooms' => 2, 'price' => 10000000, 'hasPatio' => true, 'hasAmueblado' => true, 'hasParking' => true, 'lat' => -26.1830, 'lng' => -58.1815, 'reference' => 'Casa céntrica con patio y piscina', 'description' => 'Lista para mudarse, amueblada y equipada.', 'filters_slugs' => ['estacionamiento', 'cocina', 'piscina', 'aire_acondicionado'] ],
            [ 'type' => 'departamento', 'accommodationType' => 'apartamento', 'neighborhood' => 'Microcentro', 'rooms' => 1, 'bathrooms' => 1, 'price' => 6000000, 'hasPatio' => false, 'hasAmueblado' => true, 'hasParking' => false, 'lat' => -26.1860, 'lng' => -58.1825, 'reference' => 'Loft de diseño con balcón', 'description' => 'Excelentes acabados, cerca de tiendas.', 'filters_slugs' => ['balcon', 'wifi_gratis', 'acceso_ascensor', 'tv_pantalla_plana'] ],
            [ 'type' => 'casa', 'accommodationType' => 'residencial', 'neighborhood' => 'La Floresta', 'rooms' => 4, 'bathrooms' => 3, 'price' => 13000000, 'hasPatio' => true, 'hasAmueblado' => true, 'hasParking' => true, 'lat' => -26.1610, 'lng' => -58.1860, 'reference' => 'Residencial con hidromasaje en la habitación', 'description' => 'Seguridad 24h y áreas verdes comunes.', 'filters_slugs' => ['piscina_privada', 'gimnasio', 'banera_hidromasaje_habitacion', 'solo_adultos'] ],
            [ 'type' => 'ph', 'accommodationType' => 'habitacion_particular', 'neighborhood' => 'Villa del Carmen', 'rooms' => 2, 'bathrooms' => 1, 'price' => 4900000, 'hasPatio' => true, 'hasAmueblado' => true, 'hasParking' => false, 'lat' => -26.1990, 'lng' => -58.1610, 'reference' => 'PH con dos habitaciones y cocina', 'description' => 'Ideal para compartir, se aceptan mascotas.', 'filters_slugs' => ['bano_privado', 'cocina', 'admite_mascotas'] ],
            [ 'type' => 'terreno', 'accommodationType' => 'alquiler', 'neighborhood' => 'San Miguel', 'rooms' => 0, 'bathrooms' => 0, 'price' => 3500000, 'hasPatio' => false, 'hasAmueblado' => false, 'hasParking' => false, 'lat' => -26.1710, 'lng' => -58.2010, 'reference' => 'Lote cerca del acceso principal', 'description' => 'Buena oportunidad de inversión, documentación al día.', 'filters_slugs' => [] ],
            [ 'type' => 'casa', 'accommodationType' => 'villa', 'neighborhood' => 'Costanera', 'rooms' => 6, 'bathrooms' => 5, 'price' => 30000000, 'hasPatio' => true, 'hasAmueblado' => true, 'hasParking' => true, 'lat' => -26.1740, 'lng' => -58.1800, 'reference' => 'Villa de superlujo frente al río', 'description' => 'Piscina, cine y sauna con vistas. Solo para adultos.', 'filters_slugs' => ['piscina', 'jacuzzi', 'cine', 'sala_juegos', 'sauna', 'solo_adultos', 'traslado_aeropuerto'] ],
            [ 'type' => 'departamento', 'accommodationType' => 'hotel', 'neighborhood' => 'San Francisco', 'rooms' => 2, 'bathrooms' => 2, 'price' => 8200000, 'hasPatio' => false, 'hasAmueblado' => true, 'hasParking' => true, 'lat' => -26.1690, 'lng' => -58.1890, 'reference' => 'Apart hotel con desayuno incluido', 'description' => 'Acceso a gimnasio y restaurante.', 'filters_slugs' => ['restaurante', 'traslado_aeropuerto', 'recepcion_24_horas', 'gimnasio'] ],
            [ 'type' => 'casa', 'accommodationType' => 'cabana', 'neighborhood' => 'Herradura', 'rooms' => 3, 'bathrooms' => 2, 'price' => 9500000, 'hasPatio' => true, 'hasAmueblado' => true, 'hasParking' => true, 'lat' => -26.1460, 'lng' => -58.1610, 'reference' => 'Cabaña con piscina y vistas', 'description' => 'Entorno natural, ideal para desconectar.', 'filters_slugs' => ['chimenea', 'vistas_montana', 'piscina', 'wifi_gratis', 'estacionamiento'] ],
            [ 'type' => 'departamento', 'accommodationType' => 'albergue', 'neighborhood' => 'El Pucú', 'rooms' => 10, 'bathrooms' => 8, 'price' => 5500000, 'hasPatio' => true, 'hasAmueblado' => false, 'hasParking' => false, 'lat' => -26.1910, 'lng' => -58.1560, 'reference' => 'Albergue de gran capacidad', 'description' => 'Adaptado y permite mascotas, cerca de zona verde.', 'filters_slugs' => ['adaptado_sillas_ruedas', 'admite_mascotas', 'cocina', 'wifi_gratis'] ],
            [ 'type' => 'casa', 'accommodationType' => 'casa_chalet', 'neighborhood' => 'Villa Jardín', 'rooms' => 4, 'bathrooms' => 3, 'price' => 16000000, 'hasPatio' => true, 'hasAmueblado' => true, 'hasParking' => true, 'lat' => -26.1780, 'lng' => -58.2060, 'reference' => 'Chalet con pileta privada y gimnasio', 'description' => 'Casa moderna con todas las comodidades de lujo.', 'filters_slugs' => ['estacionamiento', 'piscina_privada', 'gimnasio', 'aire_acondicionado', 'tv_pantalla_plana'] ],
        ];


        // 5. Insertar Propiedades y Adjuntar Filtros
        foreach ($sampleProperties as $propData) {
            // A. Obtener IDs de lookups
            $tipoPropiedadId = $tiposPropiedad->get($propData['type'])->id ?? null;
            $tipoEstanciaId = $tiposEstancia->get($propData['accommodationType'])->id ?? null;

            if (is_null($tipoPropiedadId) || is_null($tipoEstanciaId)) {
                // Esto te avisará si falta algún slug, aunque ya lo corregimos
                echo "Warning: Saltando propiedad por slug no encontrado: " . $propData['type'] . " o " . $propData['accommodationType'] . "\n";
                continue;
            }

            // B. Insertar la Propiedad
            $propiedad = Propiedad::create([
                'id_usuario' => $dummyUserId,
                'id_tipo_propiedad' => $tipoPropiedadId,
                'id_tipo_estancia' => $tipoEstanciaId,
                
                'titulo' => substr($propData['description'], 0, 150),
                'descripcion' => $propData['description'],
                'barrio' => $propData['neighborhood'],
                'referencia_ubicacion' => $propData['reference'],

                'latitud' => $propData['lat'],
                'longitud' => $propData['lng'],
                'precio_pesos' => $propData['price'],
                
                'numero_habitaciones' => $propData['rooms'],
                'numero_baños' => $propData['bathrooms'],
                
                // Mapeo directo de booleanos
                'tiene_patio' => $propData['hasPatio'],
                'amueblado' => $propData['hasAmueblado'],
                'tiene_parking' => $propData['hasParking'],
            ]);

            // C. Adjuntar los filtros a través del slug
            $filtroIds = [];
            foreach ($propData['filters_slugs'] as $slug) {
                if ($filtros->has($slug)) {
                    $filtroIds[] = $filtros->get($slug)->id;
                }
            }

            // Usar la relación Many-to-Many
            $propiedad->filtros()->attach($filtroIds);
        }
    }
}