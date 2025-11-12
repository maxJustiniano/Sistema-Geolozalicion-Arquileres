<?php

namespace App\Livewire\IdentidadUsuario;

use App\Livewire\Shared\DataTable; 
use Illuminate\Database\Eloquent\Builder;
use App\Models\User; // 1. Importar el nuevo modelo de la vista

// Extiende de tu clase base
class UsuarioTable extends DataTable
{
    // Cambiamos el nombre de la tabla para reflejar el contenido completo
    public $nombre_tabla = 'Gestión de Usuarios';
    public $url_edit='usuarios.edit';
    public $url_create='usuarios.create';
    public $url_delet='usuarios.destroy';

    public function mount()
    {
        // 2. Asignar el modelo de la Vista SQL
        $this->model = User::class; 

        // 3. Actualizar columnas: Ahora son directas de la vista
        $this->searchColumns = [
            'name',
            'nombre_persona',
            'apellido_persona',
            'dni_persona',
            'telefono_persona', // Antes era 'user.name'
            'email',          // Antes era 'user.email'
        ];

        $this->files = [
            'name',
            'nombre_persona',
            'apellido_persona',
            'dni_persona',
            'telefono_persona', // Antes era 'user.name'
            'email',      // Tipo de Usuario directo de la vista
        ];

        $this->labels = [
            'Nombre', 
            'Apellido', 
            'Nombre de Usuario', 
            'DNI', 
            'Email', 
            'Teléfono'
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