<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nombre del producto')
                    ->required()
                    ->maxLength(150),

                Select::make('category_id')
                    ->label('Categoría')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload()
                    ->nullable(),

                Textarea::make('description')
                    ->label('Descripción')
                    ->rows(4)
                    ->columnSpanFull(),

                TextInput::make('price')
                    ->label('Precio')
                    ->numeric()
                    ->prefix('₡')
                    ->minValue(0),

                Select::make('stock_status')
                    ->label('Estado del producto')
                    ->options([
                        'available' => 'Disponible',
                        'out_of_stock' => 'Agotado',
                        'on_request' => 'Bajo pedido',
                    ])
                    ->default('available')
                    ->required(),

                FileUpload::make('main_image')
                    ->label('Imagen principal')
                    ->image()
                    ->disk('public')
                    ->directory('products')
                    ->visibility('public')
                    ->acceptedFileTypes([
                        'image/jpeg',
                        'image/png',
                        'image/webp',
                    ])
                    ->maxSize(4096)
                    ->imageEditor()
                    ->imageEditorAspectRatios([
                        '1:1',
                        '4:3',
                        '16:9',
                    ])
                    ->helperText('Sube una imagen JPG, PNG o WebP. Máximo 4 MB.'),

                Toggle::make('is_active')
                    ->label('Visible en catálogo')
                    ->default(true),

                Toggle::make('is_featured')
                    ->label('Producto destacado')
                    ->default(false),
            ]);
    }
}
