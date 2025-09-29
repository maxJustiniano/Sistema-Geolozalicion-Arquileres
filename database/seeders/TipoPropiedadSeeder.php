<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoPropiedadSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tipo_propiedad')->insert([
            ['id' => 1, 'tipo_propiedad' => 'Departamento'],
            ['id' => 2, 'tipo_propiedad' => 'Vivienda'],
        ]);
    }
}
