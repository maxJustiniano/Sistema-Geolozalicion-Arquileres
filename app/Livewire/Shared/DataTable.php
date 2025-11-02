<?php

namespace App\Livewire\Shared;

use Livewire\Component;
use Livewire\Attributes\Url;
use Illuminate\Database\Eloquent\Builder;

// Esta es tu CLASE BASE. No la volverás a llamar directamente.
abstract class DataTable extends Component
{
    public $model;
    public $searchColumns = [];
    public $files;
    public $labels;

    #[Url(except: '')]
    public $search = '';

    // ¡OJO! No necesitas un 'mount' aquí si las clases hijas
    // van a definir las propiedades.

    /**
     * Construye la consulta base.
     * Las clases hijas pueden sobrescribir esto para añadir lógica.
     */
    protected function buildQuery(): Builder
    {
        $query = $this->model::query();

        if (!empty($this->search) && !empty($this->searchColumns)) {
            $searchTerm = '%' . $this->search . '%';

            $query->where(function (Builder $q) use ($searchTerm) {
                foreach ($this->searchColumns as $column) {
                    $q->orWhere($column, 'like', $searchTerm);
                }
            });
        }
        
        return $query;
    }

    public function resetSearch()
    {
        $this->search = ''; 
    }

    public function render()
    {
        $datos = $this->buildQuery()->paginate(10); 

        // IMPORTANTE: Todos los hijos usarán esta misma vista
        return view('livewire.shared.data-table', [
            'datos' => $datos,
        ]);
    }
}