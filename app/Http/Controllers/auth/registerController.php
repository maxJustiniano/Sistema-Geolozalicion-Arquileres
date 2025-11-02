<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Http\Request;
use App\Models\IdentidadUsuario\Persona;
use App\Models\User; // Necesario para buscar al usuario después del registro


class registerController extends Controller
{

    private function getRoleId(string $tipo_usuario): int
    {
        return match ($tipo_usuario) {
            'propietario' => 1,   // ID del rol 'Propietario' (Ajusta si es necesario)
            'inquilino' => 2,  // ID del rol 'Inquilino' (Ajusta si es necesario)
        };
    }

    public function create()
    {
        return view('livewire.auth.register');
    }

    public function store(Request $request)
    {

        // 1. VALIDACIÓN
        $request->validate([
            'nombre' => ['required', 'string', 'max:100'],
            'apellido' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'telefono' => ['nullable', 'string', 'max:20'],
            // DNI es requerido y debe ser exactamente 8 dígitos
            'dni' => ['required', 'string', 'digits:8', 'unique:personas,dni'],
            'contraseña' => ['required', 'confirmed', Rules\Password::defaults()],
            'tipo_usuario' => ['required', 'in:propietario,inquilino'],
            // Asumiendo que 'terminos' es requerido
            'terminos' => ['required', 'accepted'],
        ], [
            // Mensajes de error personalizados para el DNI (ejemplo)
            'dni.digits' => 'El DNI debe tener exactamente 8 dígitos.',
            'dni.unique' => 'Ya existe un usuario con este DNI.',
            'terminos.required' => 'Debes aceptar los Términos y Condiciones.',
            'terminos.accepted' => 'Debes aceptar los Términos y Condiciones.',
            'email.unique' => 'Este email ya está registrado.',
        ]);

        // 2. PREPARACIÓN DE DATOS
        $hashedPassword = Hash::make($request->contraseña);
        $idRol = $this->getRoleId($request->tipo_usuario);

        // 4. CREAR REGISTRO DE USUARIO, ENLAZADO A LA PERSONA
        $user = User::create([
            'name' => $request->nombre . '-' . $request->apellido, // Nombre completo
            'email' => $request->email,
            'password' => $hashedPassword,
            'id_rol' => $idRol,
        ]);

        // 3. CREAR REGISTRO DE PERSONA
        $persona = Persona::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'dni' => $request->dni,
            'telefono' => $request->telefono,
            'user_id' => $user->id,
        ]);

        Auth::login($user);
        
        // Redirige al usuario al dashboard después de un registro exitoso.
        return redirect()->route('dashboard');
    }
}
