<?php

namespace App\Http\Controllers\auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log; 
use Illuminate\Validation\Rules;
use Illuminate\Http\Request;
use App\Models\User;

class registerController extends Controller
{

    /**
     * Mapea el tipo de usuario a su ID de rol.
     * @param string $tipo_usuario
     * @return int
     */
    private function getRoleId(string $tipo_usuario): int
    {
        return match ($tipo_usuario) {
            'propietario' => 1,   // ID del rol 'Propietario' (Ajusta si es necesario)
            'inquilino' => 2,   // ID del rol 'Inquilino' (Ajusta si es necesario)
        };
    }

    /**
     * Muestra el formulario de registro.
     */
    public function create()
    {
        return view('livewire.auth.register');
    }

    /**
     * Maneja el registro de un nuevo usuario.
     */
    public function store(Request $request)
    {

        // 1. VALIDACIÓN
        $request->validate([
            'nombre' => ['required', 'string', 'max:100'],
            'apellido' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'telefono' => ['nullable', 'string', 'max:20'],
            // Se valida el DNI contra el campo 'dni_persona' de la tabla 'users'
            'dni' => ['required', 'string', 'digits:8', 'unique:users,dni_persona'],
            'contraseña' => ['required', 'confirmed', Rules\Password::defaults()],
            'tipo_usuario' => ['required', 'in:propietario,inquilino'],
            'terminos' => ['required', 'accepted'],
        ], [
            // Mensajes de error personalizados
            'dni.digits' => 'El DNI debe tener exactamente 8 dígitos.',
            // Mensaje actualizado para reflejar la tabla users/dni_persona
            'dni.unique' => 'Ya existe un usuario con este DNI.', 
            'terminos.required' => 'Debes aceptar los Términos y Condiciones.',
            'terminos.accepted' => 'Debes aceptar los Términos y Condiciones.',
            'email.unique' => 'Este email ya está registrado.',
        ]);

        // 2. CREACIÓN DIRECTA DEL USUARIO
        $idRol = $this->getRoleId($request->tipo_usuario);
        
        try {
            $user = User::create([
                // Campos de autenticación de Laravel
                'id_rol' => $idRol,
                'name' => $request->nombre . ' ' . $request->apellido, // Combinación de nombre y apellido
                'email' => $request->email,
                'password' => Hash::make($request->contraseña),

                // Campos extra de la migración 'users'
                'nombre_persona' => $request->nombre,
                'apellido_persona' => $request->apellido,
                'telefono_persona' => $request->telefono,
                'dni_persona' => $request->dni,
            ]);

        } catch (\Exception $e) {
            // Manejo de errores de creación (ej. si falla la FK id_rol)
            Log::error("Error al registrar usuario: " . $e->getMessage());
            return back()->withErrors([
                 'general' => 'No se pudo completar el registro debido a un error en la base de datos. Intente de nuevo.'
            ])->withInput();
        }


        // NOTA IMPORTANTE: Para que User::create funcione, debes asegurarte
        // de que los campos 'id_rol', 'nombre_persona', 'apellido_persona', 
        // 'telefono_persona', y 'dni_persona' estén listados en la propiedad 
        // $fillable del modelo App\Models\User.

        // 3. Autenticación y Redirección
        Auth::login($user);

        return redirect()->route('dashboard');
    }
}