<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesUserSeeder::class,
            //PersonasSeeder::class,
            TipoSeeder::class,     // 1. Tipos y Estancias (Lookups)
            FiltroSeeder::class,   // 2. Filtros (Lookups)
            //PropiedadSeeder::class // 3. Propiedades y la tabla pivote
        ]);

        User::create([
            'id_rol' => 3, // ID 3 para Administrador
            'name' => 'admin_test',
            'email' => 'admin@test.com',
            'password' => Hash::make('password'), // Contraseña simple para testeo
            'nombre_persona' => 'Admin',
            'apellido_persona' => 'Test',
            'telefono_persona' => '123456789', // Opcional
            'dni_persona' => '11111111',       // Opcional y único
        ]);
    }
}
