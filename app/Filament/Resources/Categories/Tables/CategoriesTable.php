<?php

namespace App\Filament\Resources\Categories\Tables;


use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Categoría')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('slug')
                    ->label('URL')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('description')
                    ->label('Descripción')
                    ->limit(50)
                    ->placeholder('Sin descripción'),

                IconColumn::make('is_active')
                    ->label('Activa')
                    ->boolean(),

                TextColumn::make('products_count')
                    ->label('Productos')
                    ->counts('products')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Creada')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
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
