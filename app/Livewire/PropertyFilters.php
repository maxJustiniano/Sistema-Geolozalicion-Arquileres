<?php

namespace App\Livewire;

use Livewire\Component;

class PropertyFilters extends Component
{
    public $propertyType = '';
    public $neighborhood = '';
    public $minRooms = 0;
    public $minBathrooms = 0;
    public $minPrice = 3000000;
    public $maxPrice = 12000000;
    public $hasPatio = false;
    public $hasAmueblado = false;
    public $hasParking = false;
    public $hasPool = false;
    public $petsAllowed = false;
    public $referencePlace = '';

    public function updated($field)
    {
        // Cada vez que se actualiza un campo, emitimos un evento
        $this->emit('filtersUpdated', $this->getFilters());
    }

    public function getFilters()
    {
        return [
            'propertyType' => $this->propertyType,
            'neighborhood' => $this->neighborhood,
            'minRooms' => $this->minRooms,
            'minBathrooms' => $this->minBathrooms,
            'minPrice' => $this->minPrice,
            'maxPrice' => $this->maxPrice,
            'hasPatio' => $this->hasPatio,
            'hasAmueblado' => $this->hasAmueblado,
            'hasParking' => $this->hasParking,
            'hasPool' => $this->hasPool,
            'petsAllowed' => $this->petsAllowed,
            'referencePlace' => $this->referencePlace,
        ];
    }

    public function resetFilters()
    {
        $this->reset([
            'propertyType','neighborhood','minRooms','minBathrooms',
            'minPrice','maxPrice','hasPatio','hasAmueblado',
            'hasParking','hasPool','petsAllowed','referencePlace'
        ]);
        $this->minPrice = 3000000;
        $this->maxPrice = 12000000;
        $this->emit('filtersUpdated', $this->getFilters());
    }

    public function render()
    {
        return view('livewire.property-filters');
    }
}
