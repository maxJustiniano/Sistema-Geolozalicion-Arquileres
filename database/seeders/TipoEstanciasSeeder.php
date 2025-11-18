<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoEstanciasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tipo_estancias')->insert([
            // ID 1: Corresponde a 'daily' en tu formulario (pricePeriod)
            ['id' => 1, 'tipo_estancia' => 'Por día'],
            
            // ID 2: Corresponde a 'weekly' en tu formulario
            ['id' => 2, 'tipo_estancia' => 'Semanal'],
            
            // ID 3: Corresponde a 'monthly' en tu formulario
            ['id' => 3, 'tipo_estancia' => 'Mensual'],
        ]);
    }
}