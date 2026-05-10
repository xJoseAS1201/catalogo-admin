<?php

namespace App\Filament\Resources\Settings\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('business_name')
                    ->label('Nombre del negocio')
                    ->required()
                    ->maxLength(150),

                FileUpload::make('logo')
                    ->label('Logo del negocio')
                    ->image()
                    ->disk('public')
                    ->directory('logos')
                    ->visibility('public')
                    ->acceptedFileTypes([
                        'image/jpeg',
                        'image/png',
                        'image/webp',
                    ])
                    ->maxSize(2048)
                    ->imageEditor()
                    ->helperText('Sube un logo JPG, PNG o WebP. Máximo 2 MB.'),

                TextInput::make('whatsapp_number')
                    ->label('Número de WhatsApp')
                    ->tel()
                    ->maxLength(30)
                    ->helperText('Ejemplo: 89668770. No es necesario poner +506.'),

                TextInput::make('instagram_url')
                    ->label('Instagram')
                    ->url()
                    ->maxLength(255)
                    ->placeholder('https://instagram.com/tuusuario'),

                TextInput::make('facebook_url')
                    ->label('Facebook')
                    ->url()
                    ->maxLength(255)
                    ->placeholder('https://facebook.com/tupagina'),

                Textarea::make('address')
                    ->label('Dirección')
                    ->rows(3)
                    ->columnSpanFull(),

                Textarea::make('google_maps_url')
                    ->label('Enlace de Google Maps')
                    ->rows(2)
                    ->columnSpanFull()
                    ->helperText('Pega aquí el enlace de Google Maps del negocio.'),

                Textarea::make('schedule')
                    ->label('Horario')
                    ->rows(3)
                    ->columnSpanFull()
                    ->placeholder('Lunes a sábado de 9:00 a.m. a 6:00 p.m.'),

                TextInput::make('primary_color')
                    ->label('Color principal')
                    ->default('#111827')
                    ->maxLength(20)
                    ->helperText('Ejemplo: #111827'),

                TextInput::make('secondary_color')
                    ->label('Color secundario')
                    ->default('#f59e0b')
                    ->maxLength(20)
                    ->helperText('Ejemplo: #f59e0b'),

                TextInput::make('footer_text')
                    ->label('Texto del footer')
                    ->maxLength(255)
                    ->placeholder('Catálogo digital desarrollado por TuMarca'),
            ]);
    }
}
