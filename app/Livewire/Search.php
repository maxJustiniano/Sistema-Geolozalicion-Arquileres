<?php

namespace App\Livewire;

use Livewire\Component;

class Search extends Component
{
    // Propiedad que se enlaza al input
    public $search = '';

    // Este método se ejecuta automáticamente cuando $search cambia
    public function updatedSearch($value)
    {
        // Emitimos un evento global con el nuevo valor de búsqueda.
        // El componente Propiedades lo estará escuchando.
        $this->dispatch('searchUpdated', value: $value);
    }

    public function render()
    {
        return view('livewire.search');
    }
}
