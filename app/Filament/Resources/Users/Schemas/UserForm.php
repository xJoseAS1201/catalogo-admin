<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nombre')
                    ->required()
                    ->maxLength(255),

                TextInput::make('email')
                    ->label('Correo electrónico')
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),

                TextInput::make('password')
                    ->label('Contraseña')
                    ->password()
                    ->revealable()
                    ->required(fn (string $operation): bool => $operation === 'create')
                    ->dehydrateStateUsing(fn ($state) => filled($state) ? Hash::make($state) : null)
                    ->dehydrated(fn ($state) => filled($state))
                    ->maxLength(255)
                    ->helperText('Al editar un usuario, deja este campo vacío si no deseas cambiar la contraseña.'),

                Select::make('role')
                    ->label('Rol')
                    ->options([
                        'super_admin' => 'Super Admin',
                        'owner' => 'Owner / Dueño',
                        'staff' => 'Staff / Colaborador',
                    ])
                    ->required()
                    ->default('staff'),

                Toggle::make('is_active')
                    ->label('Usuario activo')
                    ->default(true),
            ]);
    }
}
