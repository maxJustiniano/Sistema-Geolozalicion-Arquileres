<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\TipoUser; 

class TipoUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Se pueden insertar los datos de varias formas.

        // Opción 1: Usando el constructor de consultas de Laravel (DB)
        DB::table('tipo_users')->insert([
            ['tipo_usuario' => 'simple'],
            ['tipo_usuario' => 'admin'],
        ]);

    }
}