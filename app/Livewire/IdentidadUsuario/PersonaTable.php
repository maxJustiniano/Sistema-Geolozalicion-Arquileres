<?php

namespace App\Livewire\IdentidadUsuario;

// 1. Importa tu clase base
use App\Livewire\Shared\DataTable; 
use Illuminate\Database\Eloquent\Builder;

// 2. Extiende de tu clase base
class PersonaTable extends DataTable
{
    public $nombre_tabla  = 'Personas';
    /**
     * 3. Configura las propiedades en el 'mount'
     * Aquí es donde pones la lógica que antes tenías en la vista.
     */
    public function mount()
    {
        $this->model = \App\Models\IdentidadUsuario\Persona::class;
        $this->searchColumns = ['apellido', 'nombre', 'telefono', 'dni'];
        $this->files = ['id', 'apellido', 'nombre', 'telefono', 'dni'];
        $this->labels = ['ID', 'Apellido', 'Nombre', 'Telefono', 'DNI'];
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