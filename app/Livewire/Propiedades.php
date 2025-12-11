<?php

namespace App\Livewire;

use App\Models\Propiedades\Propiedad;
use Livewire\Component;
use Livewire\WithPagination;

class Propiedades extends Component
{
    use WithPagination;

    // Propiedad para almacenar el valor de búsqueda
    public $search = '';

    // LISTENER: Define qué métodos deben ejecutarse cuando se emite un evento específico.
    protected $listeners = ['searchUpdated' => 'applySearch'];

    public $nombre_tabla = 'Gestión de Usuarios';
    public $url_edit='usuarios.edit';
    public $url_create='usuarios.create';
    public $url_delet='usuarios.destroy';

    // Método que actualiza la propiedad y resetea la paginación
    public function applySearch($value)
    {
        $this->search = $value;
        $this->resetPage();
    }

    // Método que se ejecuta al renderizar el componente
    public function render()
    {
        $query = Propiedad::orderBy('fecha_publicacion', 'desc');

        // Aplicar filtro de búsqueda si $search tiene contenido
        if ($this->search) {
            $query->where(function ($q) {
                // Buscar coincidencias en el título o descripción
                $q->where('titulo', 'like', '%'.$this->search.'%')
                  ->orWhere('descripcion', 'like', '%'.$this->search.'%');
            });
        }

        $properties = $query->paginate(10);

        return view('livewire.propiedades', [
            'Propiedades' => $properties,
        ]);
    }
}
