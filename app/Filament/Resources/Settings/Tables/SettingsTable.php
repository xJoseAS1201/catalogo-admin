<?php

namespace App\Filament\Resources\Settings\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SettingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('logo')
                    ->label('Logo')
                    ->disk('public')
                    ->square(),

                TextColumn::make('business_name')
                    ->label('Negocio')
                    ->searchable(),

                TextColumn::make('whatsapp_number')
                    ->label('WhatsApp')
                    ->placeholder('Sin WhatsApp'),

                TextColumn::make('instagram_url')
                    ->label('Instagram')
                    ->limit(35)
                    ->placeholder('Sin Instagram'),

                TextColumn::make('updated_at')
                    ->label('Actualizado')
                    ->dateTime('d/m/Y')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make()
                    ->label('Editar configuración'),
            ])
            ->toolbarActions([
                //
            ]);
    }
}
