<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Información de la categoría')
                    ->description('Define cómo se organizarán los productos dentro del catálogo.')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nombre de la categoría')
                            ->placeholder('Ejemplo: Iluminación, Audio, Accesorios')
                            ->required()
                            ->maxLength(120),

                        Textarea::make('description')
                            ->label('Descripción')
                            ->placeholder('Agrega una breve descripción de los productos que pertenecen a esta categoría.')
                            ->rows(4)
                            ->columnSpanFull(),
                    ])
                    ->columns(1),

                Section::make('Visibilidad')
                    ->description('Controla si esta categoría estará disponible en el catálogo público.')
                    ->schema([
                        Toggle::make('is_active')
                            ->label('Categoría activa')
                            ->helperText('Si está apagado, la categoría no se mostrará al público.')
                            ->default(true),
                    ]),
            ]);
    }
}
