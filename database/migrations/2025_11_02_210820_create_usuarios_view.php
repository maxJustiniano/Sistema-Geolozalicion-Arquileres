<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB; // Necesario para ejecutar SQL crudo

return new class extends Migration
{
    private const VIEW_NAME = 'vista_personas_usuarios_roles';

    public function up(): void
    {
        // 1. Eliminar la vista si ya existe (Hace el método UP idempotente y seguro)
        DB::statement('DROP VIEW IF EXISTS ' . self::VIEW_NAME . ';');
        
        // 2. Crear la vista
        DB::statement("
            CREATE VIEW " . self::VIEW_NAME . " AS
            SELECT
                p.id AS persona_id,
                p.nombre,
                p.apellido,
                p.dni,
                p.telefono,
                u.id AS user_id,
                u.name AS nombre_usuario,
                u.email,
                r.nombre_rol,
                p.created_at,
                p.updated_at
            FROM
                personas p
            INNER JOIN
                users u ON p.user_id = u.id
            INNER JOIN
                roles r ON u.id_rol = r.id;
        ");
    }

    public function down(): void
    {
        // El método down ya debería ser seguro, pero lo confirmamos
        DB::statement('DROP VIEW IF EXISTS ' . self::VIEW_NAME . ';');
    }
};