<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB; // ¡Importar DB!

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $sql = "
            CREATE VIEW vista_personas_usuarios_roles AS
            SELECT
                p.id AS persona_id,     -- ID de Persona
                p.nombre,
                p.apellido,
                p.dni,
                p.telefono,
                u.id AS user_id,        -- ID de Usuario
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
        ";
        DB::statement($sql);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // SQL para eliminar la Vista si se revierte la migración
        DB::statement("DROP VIEW IF EXISTS vista_personas_usuarios_roles");
    }
};
