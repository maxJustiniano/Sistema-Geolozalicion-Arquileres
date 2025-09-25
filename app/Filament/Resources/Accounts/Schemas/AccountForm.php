<?php

namespace App\Filament\Resources\Accounts\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AccountForm
{
    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            TextInput::make('id_rol')
    ->label('Rol')
    ->numeric()
    ->required(),

            Select::make('id_persona')
    ->label('Persona')
    ->relationship('persona', 'nombre')
    ->required(),

            TextInput::make('nombre')
                ->label('Nombre')
                ->required(),

            TextInput::make('contraseña')
    ->label('Contraseña')
    ->password()
    ->dehydrateStateUsing(fn ($state) => \Illuminate\Support\Facades\Hash::make($state))
    ->required()
    ->visibleOn('create'),

            DatePicker::make('fecha_registro')
                ->label('Fecha de Registro')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('nombre')
    ->label('Nombre')
    ->searchable()
    ->sortable(),

            TextColumn::make('fecha_registro')
                ->label('Fecha de Registro')
                ->date('d/m/Y'),
        ])->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ]);
    }
}
