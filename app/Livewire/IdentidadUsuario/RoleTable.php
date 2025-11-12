<?php

namespace App\Livewire\IdentidadUsuario;

// 1. Importa tu clase base
use App\Livewire\Shared\DataTable; 
use Illuminate\Database\Eloquent\Builder;
use App\Models\IdentidadUsuario\Role;

// 2. Extiende de tu clase base
class RoleTable extends DataTable
{
    public $nombre_tabla  = 'Tipo de Usuarios';
    public $url_edit='roles.edit';
    public $url_create='roles.create';
    public $url_delet='roles.destroy';
    /**url_create
     * 3. Configura las propiedades en el 'mount'
     * Aquí es donde pones la lógica que antes tenías en la vista.
     */
    public function mount()
    {
        $this->model = Role::class;
        $this->searchColumns = ['nombre_rol'];
        $this->files = ['id', 'nombre_rol'];
        $this->labels = ['ID', 'Rol'];
    }

    /**
     * 4. (Opcional) ¡Aquí está la magia!
     * Sobrescribe el método buildQuery para añadir lógica específica.
     */
    protected function buildQuery(): Builder
    {
        // Llama a la lógica del padre (búsqueda, etc.)
        $query = parent::buildQuery(); 

        // Añade tu lógica específica de "Persona"
        //$query->where('esta_activo', 1)
        //      ->with('relacion_ejemplo'); // por ejemplo

        return $query;
    }

    // 5. ¡No necesitas un método render()!
    //    Usará automáticamente el render() y la vista del padre 
    //    (livewire.shared.data-table.blade.php).
}