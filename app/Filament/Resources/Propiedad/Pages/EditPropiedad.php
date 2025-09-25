<?php

namespace App\Filament\Resources\Propiedad\Pages;

use App\Filament\Resources\Propiedad\PropiedadResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPropiedad extends EditRecord
{
    protected static string $resource = PropiedadResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
