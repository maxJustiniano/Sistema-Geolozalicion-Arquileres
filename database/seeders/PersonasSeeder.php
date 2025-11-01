<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonasSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('personas')->insert([
            ['id' => 1, 'nombre' => 'Alex', 'apellido' => 'Gómez', 'telefono' => '3412345678'],
            ['id' => 2, 'nombre' => 'Junior', 'apellido' => 'Martínez', 'telefono' => '3412345679'],
            ['id' => 3, 'nombre' => 'Tomi', 'apellido' => 'Fernández', 'telefono' => '3412345680'],
        ]);
    }
}
