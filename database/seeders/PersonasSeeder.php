<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonasSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('personas')->insert([
            ['id' => 1, 'nombre' => 'Alex', 'apellido' => 'Gómez', 'telefono' => '3412345678', 'email' => 'alex@example.com'],
            ['id' => 2, 'nombre' => 'Junior', 'apellido' => 'Martínez', 'telefono' => '3412345679', 'email' => 'junior@example.com'],
            ['id' => 3, 'nombre' => 'Tomi', 'apellido' => 'Fernández', 'telefono' => '3412345680', 'email' => 'tomi@example.com'],
        ]);
    }
}
