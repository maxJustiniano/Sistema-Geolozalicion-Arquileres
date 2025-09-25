<?php

namespace App\Filament\Resources\Propiedad\Pages;

use App\Filament\Resources\Propiedad\PropiedadResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPropiedad extends ListRecords
{
    protected static string $resource = PropiedadResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
