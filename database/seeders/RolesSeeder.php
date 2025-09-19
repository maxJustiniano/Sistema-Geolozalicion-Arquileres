<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    public function run()
    {
        Role::firstOrCreate(['name' => 'usuario']);
        Role::firstOrCreate(['name' => 'propietario']);
        Role::firstOrCreate(['name' => 'administrador']);
    }
}
