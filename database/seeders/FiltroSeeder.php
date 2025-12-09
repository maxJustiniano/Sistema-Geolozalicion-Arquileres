<?php

namespace Database\Seeders;

use App\Models\Filtro;
use Illuminate\Database\Seeder;

class FiltroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $filtrosData = [
            // CATEGORIA: facility (Instalaciones)
            ['slug' => 'estacionamiento', 'nombre' => 'Estacionamiento', 'categoria' => 'facility'],
            ['slug' => 'wifi_gratis', 'nombre' => 'Wifi Gratis', 'categoria' => 'facility'],
            ['slug' => 'recepcion_24_horas', 'nombre' => 'Recepción 24 horas', 'categoria' => 'facility'],
            ['slug' => 'gimnasio', 'nombre' => 'Gimnasio', 'categoria' => 'facility'],
            ['slug' => 'restaurante', 'nombre' => 'Restaurante', 'categoria' => 'facility'],
            ['slug' => 'servicio_habitaciones', 'nombre' => 'Servicio de habitaciones', 'categoria' => 'facility'],
            ['slug' => 'spa_bienestar', 'nombre' => 'Spa y bienestar', 'categoria' => 'facility'],
            ['slug' => 'jacuzzi', 'nombre' => 'Jacuzzi', 'categoria' => 'facility'],
            
            // CATEGORIA: roomService (Servicios de la habitación)
            ['slug' => 'bano_privado', 'nombre' => 'Baño privado', 'categoria' => 'roomService'],
            ['slug' => 'cocina', 'nombre' => 'Cocina', 'categoria' => 'roomService'],
            ['slug' => 'aire_acondicionado', 'nombre' => 'Aire acondicionado', 'categoria' => 'roomService'],
            ['slug' => 'balcon', 'nombre' => 'Balcón', 'categoria' => 'roomService'],
            ['slug' => 'piscina_privada', 'nombre' => 'Piscina privada', 'categoria' => 'roomService'],
            ['slug' => 'banera_hidromasaje_habitacion', 'nombre' => 'Bañera de hidromasaje', 'categoria' => 'roomService'],
            ['slug' => 'sauna', 'nombre' => 'Sauna', 'categoria' => 'roomService'],
            ['slug' => 'chimenea', 'nombre' => 'Chimenea', 'categoria' => 'roomService'],
            ['slug' => 'acceso_ascensor', 'nombre' => 'Acceso a ascensor', 'categoria' => 'roomService'],
            ['slug' => 'tv_pantalla_plana', 'nombre' => 'TV pantalla plana', 'categoria' => 'roomService'],
            ['slug' => 'vistas', 'nombre' => 'Vistas', 'categoria' => 'roomService'],
            ['slug' => 'vistas_montana', 'nombre' => 'Vistas a la montaña', 'categoria' => 'roomService'],

            // CATEGORIA: groupType (Tipo de Grupo)
            ['slug' => 'admite_mascotas', 'nombre' => 'Admite mascotas', 'categoria' => 'groupType'],
            ['slug' => 'solo_adultos', 'nombre' => 'Solo para adultos', 'categoria' => 'groupType'],
            
            // CATEGORIA: funType (Para pasarlo bien - Solo 'piscina' aparece en tus datos como un funType distinto)
            ['slug' => 'piscina', 'nombre' => 'Piscina', 'categoria' => 'funType'],
        ];

        foreach ($filtrosData as $filtro) {
            Filtro::firstOrCreate(['slug' => $filtro['slug']], $filtro);
        }
    }
}