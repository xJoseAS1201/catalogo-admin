<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Información del producto')
                    ->description('Datos principales que verá el cliente en el catálogo.')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nombre del producto')
                            ->placeholder('Ejemplo: Halógenos LED H11')
                            ->required()
                            ->maxLength(150),

                        Select::make('category_id')
                            ->label('Categoría')
                            ->relationship('category', 'name')
                            ->searchable()
                            ->preload()
                            ->placeholder('Selecciona una categoría')
                            ->nullable(),

                        Textarea::make('description')
                            ->label('Descripción')
                            ->placeholder('Describe brevemente el producto, características, compatibilidad o detalles importantes.')
                            ->rows(5)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Precio y disponibilidad')
                    ->description('Define el precio y el estado visible para el cliente.')
                    ->schema([
                        TextInput::make('price')
                            ->label('Precio')
                            ->numeric()
                            ->prefix('₡')
                            ->minValue(0)
                            ->placeholder('Ejemplo: 18000'),

                        Select::make('stock_status')
                            ->label('Estado del producto')
                            ->options([
                                'available' => 'Disponible',
                                'out_of_stock' => 'Agotado',
                                'on_request' => 'Bajo pedido',
                            ])
                            ->default('available')
                            ->required(),
                    ])
                    ->columns(2),

                Section::make('Imagen principal')
                    ->description('Esta imagen será la portada del producto en el catálogo.')
                    ->schema([
                        FileUpload::make('main_image')
                            ->label('Imagen del producto')
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
                            ->helperText('Formatos permitidos: JPG, PNG o WebP. Tamaño máximo: 4 MB.'),
                    ]),

                Section::make('Visibilidad')
                    ->description('Controla si el producto aparece en el catálogo y si se muestra como destacado.')
                    ->schema([
                        Toggle::make('is_active')
                            ->label('Visible en catálogo')
                            ->helperText('Si está apagado, el producto no se mostrará al público.')
                            ->default(true),

                        Toggle::make('is_featured')
                            ->label('Producto destacado')
                            ->helperText('Si está encendido, el producto puede aparecer en la sección de destacados.')
                            ->default(false),
                    ])
                    ->columns(2),
            ]);
    }
}
