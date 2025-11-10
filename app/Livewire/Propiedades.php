<?php

namespace App\Livewire;

use App\Models\Propiedades\Propiedad;
use Livewire\Component;
use Livewire\WithPagination;

class Propiedades extends Component
{
    use WithPagination;

    // Método que se ejecuta al renderizar el componente
    public function render()
    {
        // 1. Lógica de obtención de datos usando tu modelo Propiedad
        $properties = Propiedad::orderBy('fecha_publicacion', 'desc')->paginate(10);

        // 2. Retorna la vista de Livewire, pasando la colección de propiedades
        return view('livewire.Propiedades', [
            'Propiedades' => $properties,
        ]);
    }
}
