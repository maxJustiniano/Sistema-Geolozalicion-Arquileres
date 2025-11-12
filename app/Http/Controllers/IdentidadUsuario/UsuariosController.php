<?php

namespace App\Http\Controllers\IdentidadUsuario;

use App\Models\User;
use App\Models\IdentidadUsuario\Role; // Asegúrate de que esta ruta del modelo Role sea correcta
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UsuariosController
{
    /**
     * Muestra la lista de recursos (usuarios).
     */
    public function index()
    {
        // En una aplicación real con Livewire, esta vista solo cargaría el componente de tabla.
        // Ejemplo: return view('users.index');
        
        // Para propósito de ejemplo, solo mostramos un mensaje:
        return view('usuarios.index');
    }

    /**
     * Muestra el formulario para crear un nuevo recurso.
     */
    public function create()
    {
        $roles = Role::all();
        
        return view('usuarios.form', [
            'action' => route('usuarios.store'),
            'method' => 'POST',
            'routeIndex' => 'usuarios.index',
            'user' => new User(), // Instancia vacía
            'roles' => $roles,
        ]);
    }

    /**
     * Almacena un recurso recién creado en el almacenamiento.
     */
    public function store(Request $request)
    {
        // 1. Validación
        $validated = $request->validate([
            'id_rol' => ['required', 'exists:roles,id'],
            'name' => ['required', 'string', 'max:255', 'unique:users,name'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'], // Se requiere confirmación (password_confirmation)
            'nombre_persona' => ['required', 'string', 'max:100'],
            'apellido_persona' => ['required', 'string', 'max:100'],
            'telefono_persona' => ['nullable', 'string', 'max:20'],
            'dni_persona' => ['nullable', 'string', 'digits:8', 'unique:users,dni_persona'],
        ], [
            'dni_persona.digits' => 'El DNI debe tener exactamente 8 dígitos.',
            'dni_persona.unique' => 'Ya existe un usuario con este DNI.',
        ]);

        // 2. Preparar datos y encriptar contraseña
        $validated['password'] = Hash::make($validated['password']);

        // 3. Crear y guardar el nuevo usuario
        User::create($validated);

        // 4. Redirección
        return Redirect::route('usuarios.index')->with('status', 'Usuario creado exitosamente.');
    }

    /**
     * Muestra el formulario para editar el recurso especificado.
     */
    public function edit(User $user) // Route Model Binding (User $user)
    {
        $roles = Role::all();
        
        return view('usuarios.form', [
            // LA CLAVE 'usuario' DEBE COINCIDIR CON {usuario} DE LA URI
            'action' => route('usuarios.update', $user), 
            'method' => 'PUT',
            'routeIndex' => 'usuarios.index',
            'user' => $user, 
            'roles' => $roles,
        ]);
    }

    /**
     * Actualiza el recurso especificado en el almacenamiento.
     */
    public function update(Request $request, User $user) // Route Model Binding (User $user)
    {
        // 1. Definición de las reglas de validación
        $rules = [
            'id_rol' => ['required', 'exists:roles,id'],
            
            // Unicidad, ignorando al usuario actual ($user->id)
            'name' => ['required', 'string', 'max:255', Rule::unique('users', 'name')->ignore($user->id)],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'dni_persona' => ['nullable', 'string', 'digits:8', Rule::unique('users', 'dni_persona')->ignore($user->id)], 
            
            'nombre_persona' => ['required', 'string', 'max:100'],
            'apellido_persona' => ['required', 'string', 'max:100'],
            'telefono_persona' => ['nullable', 'string', 'max:20'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ];
        
        // 2. Validación
        $validated = $request->validate($rules, [
            'dni_persona.digits' => 'El DNI debe tener exactamente 8 dígitos.',
            'dni_persona.unique' => 'Ya existe otro usuario con este DNI.',
        ]);
        
        $dataToUpdate = $validated;

        // 3. Manejar la Contraseña (solo si se proporciona)
        if (!empty($dataToUpdate['password'])) {
            $dataToUpdate['password'] = Hash::make($dataToUpdate['password']);
        } else {
            // Si el campo está vacío, lo eliminamos de los datos a actualizar para mantener la antigua.
            unset($dataToUpdate['password']); 
        }

        // 4. Actualizar el usuario
        $user->update($dataToUpdate);

        // 5. Redirección
        return Redirect::route('usuarios.index')->with('status', 'Usuario actualizado exitosamente.');
    }

    /**
     * Elimina el recurso especificado del almacenamiento.
     */
    public function destroy(User $user) // Route Model Binding (User $user)
    {
        $user->delete();

        return Redirect::route('usuarios.index')->with('status', 'Usuario eliminado correctamente.');
    }
    
    // El método show(string $id) no fue implementado ya que no es común en CRUD de gestión.
}