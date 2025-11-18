<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoPropiedadesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tipo_propiedades')->insert([
            // 1. Viviendas
            ['id' => 1, 'tipo_propiedad' => 'Departamento'],
            ['id' => 2, 'tipo_propiedad' => 'Casa / Chalet'],
            ['id' => 3, 'tipo_propiedad' => 'Villa'],
            ['id' => 4, 'tipo_propiedad' => 'Cabaña'],
            ['id' => 5, 'tipo_propiedad' => 'Residencial'],
            
            // 2. Otros tipos
            ['id' => 6, 'tipo_propiedad' => 'Habitación Particular'],
            ['id' => 7, 'tipo_propiedad' => 'Terreno / Alquiler'],
            
            // 3. Alojamientos comerciales
            ['id' => 8, 'tipo_propiedad' => 'Albergue'],
            ['id' => 9, 'tipo_propiedad' => 'Hotel'],
            ['id' => 10, 'tipo_propiedad' => 'Camping'],
        ]);
    }
}
