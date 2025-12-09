<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Tipos de Propiedad (General: lo que se vende/alquila)
        $tiposPropiedad = [
            ['nombre' => 'Casa', 'slug' => 'casa'],
            ['nombre' => 'Departamento', 'slug' => 'departamento'], // Aseguramos que 'departamento' exista
            ['nombre' => 'Terreno', 'slug' => 'terreno'],
            ['nombre' => 'PH', 'slug' => 'ph'],
            ['nombre' => 'Local Comercial', 'slug' => 'local_comercial'],
        ];

        // 2. Tipos de Estancia (Categoría de Alojamiento/Uso)
        $tiposEstancia = [
            ['nombre' => 'Apartamento', 'slug' => 'apartamento'],
            ['nombre' => 'Casa y Chalet', 'slug' => 'casa_chalet'],
            ['nombre' => 'Habitaciones Particulares', 'slug' => 'habitacion_particular'],
            ['nombre' => 'Villa', 'slug' => 'villa'],
            ['nombre' => 'Alquiler', 'slug' => 'alquiler'],
            ['nombre' => 'Cabaña', 'slug' => 'cabana'],
            
            // <-- ¡ESTOS ERAN LOS FALTANTES!
            ['nombre' => 'Albergue', 'slug' => 'albergue'], 
            ['nombre' => 'Hotel', 'slug' => 'hotel'],
            ['nombre' => 'Residencial', 'slug' => 'residencial'],
            ['nombre' => 'Camping', 'slug' => 'camping'],
        ];

        // Inserción de datos (usando 'tipos_propiedades' y 'tipos_estancia' si así se llaman tus tablas)
        DB::table('tipos_propiedades')->insertOrIgnore($tiposPropiedad);
        DB::table('tipos_estancia')->insertOrIgnore($tiposEstancia);
    }
}