<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Limpiar caché de permisos para evitar conflictos
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 1 Definir todos los permisos
        $permissions = [
            'buscar propiedad',
            'seleccionar propiedad',
            'contactar propietario',
            'crear propiedad',
            'editar propiedad',
            'eliminar propiedad',
            'gestionar restricciones',
            'gestionar usuarios',
            'gestionar propietarios',
        ];
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // 2 Crear roles y asignar permisos correspondientes
        $usuario = Role::firstOrCreate(['name' => 'usuario']);
        $usuario->syncPermissions([
            'buscar propiedad',
            'seleccionar propiedad',
            'contactar propietario',
        ]);

        $propietario = Role::firstOrCreate(['name' => 'propietario']);
        $propietario->syncPermissions([
            'crear propiedad',
            'editar propiedad',
            'eliminar propiedad',
            'gestionar restricciones',
            'buscar propiedad',
            'seleccionar propiedad',
            'contactar propietario',
        ]);

        $administrador = Role::firstOrCreate(['name' => 'administrador']);
        $administrador->syncPermissions($permissions);

        // 3 Crear usuarios de ejemplo y asignarles roles
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Administrador',
                'password' => bcrypt('password'),
            ]
        );
        $adminUser->assignRole($administrador);

        $ownerUser = User::factory()->create([
            'email' => 'propietario@example.com',
            'name' => 'Propietario',
            'password' => bcrypt('password'),
        ]);
        $ownerUser->assignRole($propietario);

        $basicUser = User::factory()->create([
            'email' => 'usuario@example.com',
            'name' => 'Usuario',
            'password' => bcrypt('password'),
        ]);
        $basicUser->assignRole($usuario);
    }
}
