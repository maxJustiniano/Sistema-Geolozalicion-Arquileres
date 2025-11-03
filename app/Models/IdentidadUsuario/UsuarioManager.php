<?php

namespace App\Models\IdentidadUsuario;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class UsuarioManager
{
    /**
     * Llama al Procedimiento Almacenado SP_REGISTRAR_USUARIO.
     * Los parámetros se enlazan de forma segura para evitar inyecciones SQL.
     *
     * @param array $data Datos limpios y validados del formulario.
     * @return int|bool El ID del nuevo usuario si es exitoso, o false si hay un error.
     */
    public static function registrarUsuario(array $data)
    {
        // MySQL requiere la definición de la variable de salida antes de la llamada.
        DB::statement('SET @out_user_id = NULL;');

        // 1. La llamada al SP con placeholders '?' para la seguridad (evita inyección)
        $query = "CALL SP_REGISTRAR_USUARIO(?, ?, ?, ?, ?, ?, ?, ?, @out_user_id)";
        
        // 2. Parámetros limpios y validados
        $params = [
            $data['id_rol'],
            $data['name'],
            $data['email'],
            $data['password'],
            $data['nombre'],
            $data['apellido'],
            $data['telefono'],
            $data['dni'],
        ];

        try {
            // Ejecutar el SP de forma segura: DB::statement se encarga de enlazar los parámetros.
            DB::statement($query, $params);
            
            // 3. Recuperar el ID de usuario de la variable de salida
            $result = DB::selectOne("SELECT @out_user_id as user_id");
            
            return $result->user_id ?? false;

        } catch (Throwable $e) {
            // Manejo de errores específicos del SP (como el error '45000' que lanzamos)
            if (str_contains($e->getMessage(), 'SQL_ERROR_TRANSACTION_FAILED')) {
                Log::warning("Fallo la transacción de registro de usuario/persona en BD: " . $e->getMessage());
                // Podemos lanzar un error genérico o retornar falso
            } else {
                Log::error("Error inesperado en la llamada al SP: " . $e->getMessage());
            }
            return false;
        }
    }
}