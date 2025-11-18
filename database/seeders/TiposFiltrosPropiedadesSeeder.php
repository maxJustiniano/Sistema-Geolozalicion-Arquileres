<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TiposFiltrosPropiedadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tipos_filtros_propiedades')->insert([
            // Instalaciones (IDs 1-12)
            ['id' => 1, 'filtro_propiedad' => 'estacionamiento'],
            ['id' => 2, 'filtro_propiedad' => 'restaurante'],
            ['id' => 3, 'filtro_propiedad' => 'servicio_habitaciones'],
            ['id' => 4, 'filtro_propiedad' => 'recepcion_24_horas'],
            ['id' => 5, 'filtro_propiedad' => 'gimnasio'],
            ['id' => 6, 'filtro_propiedad' => 'traslado_aeropuerto'],
            ['id' => 7, 'filtro_propiedad' => 'spa_bienestar'],
            ['id' => 8, 'filtro_propiedad' => 'banera_hidromasaje'],
            ['id' => 9, 'filtro_propiedad' => 'jacuzzi'],
            ['id' => 10, 'filtro_propiedad' => 'wifi_gratis'],
            ['id' => 11, 'filtro_propiedad' => 'estacion_carga_vehiculos_electricos'],
            ['id' => 12, 'filtro_propiedad' => 'adaptado_sillas_ruedas'],

            // Servicios de la habitación (IDs 13-25)
            ['id' => 13, 'filtro_propiedad' => 'bano_privado'],
            ['id' => 14, 'filtro_propiedad' => 'piscina_privada'],
            ['id' => 15, 'filtro_propiedad' => 'balcon'],
            ['id' => 16, 'filtro_propiedad' => 'aire_acondicionado'],
            ['id' => 17, 'filtro_propiedad' => 'cocina'],
            ['id' => 18, 'filtro_propiedad' => 'banera_hidromasaje_habitacion'],
            ['id' => 19, 'filtro_propiedad' => 'vistas'],
            ['id' => 20, 'filtro_propiedad' => 'banera'],
            ['id' => 21, 'filtro_propiedad' => 'sauna'],
            ['id' => 22, 'filtro_propiedad' => 'chimenea'],
            ['id' => 23, 'filtro_propiedad' => 'vistas_montana'],
            ['id' => 24, 'filtro_propiedad' => 'acceso_ascensor'],
            ['id' => 25, 'filtro_propiedad' => 'tv_pantalla_plana'],

            // Tipo de Grupo (IDs 26-27)
            ['id' => 26, 'filtro_propiedad' => 'admite_mascotas'],
            ['id' => 27, 'filtro_propiedad' => 'solo_adultos'],

            // Para pasarlo bien (IDs 28-30)
            ['id' => 28, 'filtro_propiedad' => 'piscina'],
            ['id' => 29, 'filtro_propiedad' => 'sala_juegos'],
            ['id' => 30, 'filtro_propiedad' => 'cine'],
        ]);
    }
}