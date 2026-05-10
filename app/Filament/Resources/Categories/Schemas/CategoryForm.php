<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nombre de la categoría')
                    ->required()
                    ->maxLength(120),

                Textarea::make('description')
                    ->label('Descripción')
                    ->rows(3)
                    ->columnSpanFull(),

                Toggle::make('is_active')
                    ->label('Categoría activa')
                    ->default(true),
            ]);
    }
}
