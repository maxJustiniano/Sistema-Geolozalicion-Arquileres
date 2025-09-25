<?php

namespace App\Filament\Resources\Propiedad\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PropiedadForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('titulo')
                ->label('Título')
                ->required()
                ->maxLength(255),

                Textarea::make('descripcion')
                    ->label('Descripción')
                    ->rows(4)
                    ->maxLength(1000),

                DatePicker::make('fecha_publicacion')
                    ->label('Fecha de publicación')
                    ->required(),

                Select::make('id_tipo_propiedad')
                    ->label('Tipo de propiedad')
                    ->relationship('tipoPropiedad', 'tipo_propiedad')
                    ->searchable()
                    ->required(),

                Select::make('id_usuario')
                    ->label('Propietario')
                    ->relationship('usuario', 'nombre')
                    ->searchable()
                    ->required(),
            ]);
    }
}
