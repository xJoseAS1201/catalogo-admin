<?php

namespace App\Filament\Resources\Settings\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Identidad del negocio')
                    ->description('Información principal que se muestra en la página pública.')
                    ->schema([
                        TextInput::make('business_name')
                            ->label('Nombre del negocio')
                            ->placeholder('Ejemplo: Pitstore')
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
                            ->helperText('Formatos permitidos: JPG, PNG o WebP. Tamaño máximo: 2 MB.'),
                    ])
                    ->columns(1),

                Section::make('Contacto y redes sociales')
                    ->description('Datos que el cliente usará para contactar al negocio.')
                    ->schema([
                        TextInput::make('whatsapp_number')
                            ->label('Número de WhatsApp')
                            ->tel()
                            ->maxLength(30)
                            ->placeholder('Ejemplo: 89668770')
                            ->helperText('No es necesario poner +506.'),

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
                    ])
                    ->columns(3),

                Section::make('Ubicación y horario')
                    ->description('Información visible en la sección de contacto.')
                    ->schema([
                        Textarea::make('address')
                            ->label('Dirección')
                            ->rows(3)
                            ->placeholder('Ejemplo: San José, Costa Rica')
                            ->columnSpanFull(),

                        Textarea::make('google_maps_url')
                            ->label('Enlace de Google Maps')
                            ->rows(2)
                            ->placeholder('Pega aquí el enlace de Google Maps del negocio.')
                            ->columnSpanFull(),

                        Textarea::make('schedule')
                            ->label('Horario')
                            ->rows(3)
                            ->placeholder('Lunes a sábado de 9:00 a.m. a 6:00 p.m.')
                            ->columnSpanFull(),
                    ]),

                Section::make('Personalización visual')
                    ->description('Colores básicos que se aplican en la página pública.')
                    ->schema([
                        TextInput::make('primary_color')
                            ->label('Color principal')
                            ->default('#111827')
                            ->maxLength(20)
                            ->placeholder('#111827')
                            ->helperText('Debe tener formato hexadecimal. Ejemplo: #111827'),

                        TextInput::make('secondary_color')
                            ->label('Color secundario')
                            ->default('#f59e0b')
                            ->maxLength(20)
                            ->placeholder('#f59e0b')
                            ->helperText('Debe tener formato hexadecimal. Ejemplo: #f59e0b'),
                    ])
                    ->columns(2),

                Section::make('Footer')
                    ->description('Texto que aparece al final de la página pública.')
                    ->schema([
                        TextInput::make('footer_text')
                            ->label('Texto del footer')
                            ->maxLength(255)
                            ->placeholder('Catálogo digital desarrollado por TuMarca'),
                    ]),
            ]);
    }
}
