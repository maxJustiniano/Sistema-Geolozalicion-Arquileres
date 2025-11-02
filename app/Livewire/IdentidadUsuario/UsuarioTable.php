<?php

namespace App\Livewire\IdentidadUsuario;

use App\Livewire\Shared\DataTable; 
use Illuminate\Database\Eloquent\Builder;
use App\Models\IdentidadUsuario\UsuariosViews; // 1. Importar el nuevo modelo de la vista

// Extiende de tu clase base
class UsuarioTable extends DataTable
{
    // Cambiamos el nombre de la tabla para reflejar el contenido completo
    public $nombre_tabla = 'Gestión de Usuarios';

    public function mount()
    {
        // 2. Asignar el modelo de la Vista SQL
        $this->model = UsuariosViews::class; 

        // 3. Actualizar columnas: Ahora son directas de la vista
        $this->searchColumns = [
            'nombre',
            'apellido',
            'dni',
            'telefono',
            'nombre_usuario', // Antes era 'user.name'
            'email',          // Antes era 'user.email'
            'nombre_rol'      // Antes era 'user.role.nombre_rol'
        ];

        $this->files = [
            'persona_id',      
            'user_id',
            'nombre',
            'apellido',
            'nombre_usuario', // Nombre directo de la vista
            'dni',
            'email',          // Email directo de la vista
            'telefono',
            'nombre_rol'      // Tipo de Usuario directo de la vista
        ];

        $this->labels = [
            'ID Persona',      
            'ID Usuario',
            'Nombre', 
            'Apellido', 
            'Usuario', 
            'DNI', 
            'Email', 
            'Teléfono', 
            'Tipo de Usuario'
        ];
    }

    /**
     * El método buildQuery ya NO necesita sobrescribir la lógica de JOINs (with)
     */
    protected function buildQuery(): Builder
    {
        // La lógica de búsqueda (parent::buildQuery()) ahora funciona con OR WHERE
        // directamente en las columnas de la vista, sin necesidad de joins complejos.
        return parent::buildQuery(); 
    }
}