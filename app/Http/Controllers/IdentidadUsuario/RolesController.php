<?php

namespace App\Http\Controllers\IdentidadUsuario;
use Illuminate\Support\Facades\Redirect;
use  App\Models\IdentidadUsuario\Role;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class RolesController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('roles.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('roles.form',[
            'action' => route('roles.store'),
            'method' => 'POST',
            'routeIndex' => 'roles.index'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validación de los datos
        $validated = $request->validate([
            // 'unique:roles' asegura que el nombre del rol no exista
            'nombre_rol' => ['required', 'string', 'max:255', 'unique:roles'],
        ]);

        // 2. Crear y guardar el nuevo rol
        Role::create($validated);

        // 3. Redirección
        return Redirect::route('roles.index')->with('status', 'Rol creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $rol)
    {
        return view('roles.form',[
            'action' => route('roles.update', $rol),
            'method' => 'PUT',
            'routeIndex' => 'roles.index',
            'rol' => $rol
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $rol)
    {
        // 1. Validación de los datos
        $validated = $request->validate([
            'nombre_rol' => [
                'required', 
                'string', 
                'max:255', 
                // Ignora el ID del rol actual para permitir que se guarde el mismo nombre
                Rule::unique('roles')->ignore($rol->id),
            ],
        ]);

        // 2. Actualizar el rol
        $rol->update($validated);

        // 3. Redirección
        return Redirect::route('roles.index')->with('status', 'Rol actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $rol)
    {
        // 1. Eliminar el rol
        $rol->delete();

        // 2. Redirección
        return Redirect::route('roles.index')->with('status', 'Rol eliminado correctamente.');
    }
}
