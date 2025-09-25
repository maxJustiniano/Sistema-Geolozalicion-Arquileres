<?php

namespace App\Filament\Resources\Propiedad;

use App\Filament\Resources\Propiedad\Pages\CreatePropiedad;
use App\Filament\Resources\Propiedad\Pages\EditPropiedad;
use App\Filament\Resources\Propiedad\Pages\ListPropiedad;
use App\Filament\Resources\Propiedad\Schemas\PropiedadForm;
use App\Models\Propiedad;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PropiedadResource extends Resource
{
    protected static ?string $model = Propiedad::class;

    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'titulo';

    public static function form(Schema $schema): Schema
    {
        return PropiedadForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('titulo')->searchable(),
                TextColumn::make('tipoPropiedad.tipo_propiedad')->label('Tipo'),
                TextColumn::make('usuario.nombre')->label('Propietario'),
                TextColumn::make('fecha_publicacion')->date(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPropiedad::route('/'),
            'create' => CreatePropiedad::route('/create'),
            'edit' => EditPropiedad::route('/{record}/edit'),
        ];
    }
}
