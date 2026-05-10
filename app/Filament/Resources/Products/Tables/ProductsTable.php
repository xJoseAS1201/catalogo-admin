<?php

namespace App\Filament\Resources\Products\Tables;


use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('main_image')
                    ->label('Imagen')
                    ->disk('public')
                    ->square(),

                TextColumn::make('name')
                    ->label('Producto')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('category.name')
                    ->label('Categoría')
                    ->sortable()
                    ->placeholder('Sin categoría'),

                TextColumn::make('price')
                    ->label('Precio')
                    ->money('CRC')
                    ->sortable(),

                TextColumn::make('stock_status')
                    ->label('Estado')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'available' => 'Disponible',
                        'out_of_stock' => 'Agotado',
                        'on_request' => 'Bajo pedido',
                        default => $state,
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'available' => 'success',
                        'out_of_stock' => 'danger',
                        'on_request' => 'warning',
                        default => 'gray',
                    }),

                IconColumn::make('is_active')
                    ->label('Visible')
                    ->boolean(),

                IconColumn::make('is_featured')
                    ->label('Destacado')
                    ->boolean(),

                TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('category_id')
                    ->label('Categoría')
                    ->relationship('category', 'name'),

                SelectFilter::make('stock_status')
                    ->label('Estado')
                    ->options([
                        'available' => 'Disponible',
                        'out_of_stock' => 'Agotado',
                        'on_request' => 'Bajo pedido',
                    ]),
            ])
            ->recordActions([
                EditAction::make()
                    ->label('Editar'),
            ])
            ->toolbarActions([
                 //
            ]);
    }
}
