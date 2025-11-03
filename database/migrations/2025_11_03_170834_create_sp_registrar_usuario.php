<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateSpRegistrarUsuario extends Migration
{
    public function up(): void
    {
        // Solo ejecuta en MySQL, ya que otros motores no tienen la misma sintaxis o soporte SPs
        if (DB::getDriverName() !== 'mysql') {
            return;
        }

        // Definición del Procedimiento Almacenado
        $sql = "
            DROP PROCEDURE IF EXISTS SP_REGISTRAR_USUARIO;
            
            CREATE PROCEDURE SP_REGISTRAR_USUARIO(
                IN p_id_rol INT,
                IN p_name VARCHAR(255),
                IN p_email VARCHAR(255),
                IN p_password VARCHAR(255),
                IN p_nombre_persona VARCHAR(100),
                IN p_apellido_persona VARCHAR(100),
                IN p_telefono VARCHAR(20),
                IN p_dni VARCHAR(8),
                OUT o_user_id BIGINT
            )
            BEGIN
                -- Declarar variables de control de la transacción
                DECLARE exit handler FOR SQLEXCEPTION
                BEGIN
                    -- Si hay un error SQL, deshacer (rollback)
                    ROLLBACK;
                    -- Re-lanzar un error general para que Laravel lo detecte
                    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'SQL_ERROR_TRANSACTION_FAILED';
                END;

                -- Iniciar la transacción
                START TRANSACTION;

                -- 1. Insertar en la tabla 'users'
                INSERT INTO users (id_rol, name, email, password, created_at, updated_at)
                VALUES (p_id_rol, p_name, p_email, p_password, NOW(), NOW());

                -- Obtener el ID del usuario insertado
                SET @new_user_id = LAST_INSERT_ID();

                -- 2. Insertar en la tabla 'personas'
                INSERT INTO personas (user_id, nombre, apellido, telefono, dni, created_at, updated_at)
                VALUES (@new_user_id, p_nombre_persona, p_apellido_persona, p_telefono, p_dni, NOW(), NOW());

                -- Si ambas inserciones fueron exitosas, confirmar (commit)
                COMMIT;

                -- Devolver el ID del nuevo usuario
                SET o_user_id = @new_user_id;

            END;
        ";

        // Ejecutar el SQL. Usamos 'unprepared' porque contiene múltiples sentencias (DROP, CREATE)
        DB::unprepared($sql);
    }

    public function down(): void
    {
        if (DB::getDriverName() === 'mysql') {
            DB::unprepared('DROP PROCEDURE IF EXISTS SP_REGISTRAR_USUARIO;');
        }
    }
}