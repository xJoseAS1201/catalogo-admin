<?php

namespace App\Filament\Resources\Settings;

use App\Filament\Resources\Settings\Pages\CreateSetting;
use App\Filament\Resources\Settings\Pages\EditSetting;
use App\Filament\Resources\Settings\Pages\ListSettings;
use App\Filament\Resources\Settings\Schemas\SettingForm;
use App\Filament\Resources\Settings\Tables\SettingsTable;
use App\Models\Setting;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'business_name';

    public static function form(Schema $schema): Schema
    {
        return SettingForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SettingsTable::configure($table);
    }

 public static function canViewAny(): bool
{
    return auth()->user()?->isSuperAdmin() === true
        || auth()->user()?->isOwner() === true;
}

public static function canCreate(): bool
{
    $user = auth()->user();

    if (! ($user?->isSuperAdmin() || $user?->isOwner())) {
        return false;
    }

    return \App\Models\Setting::query()->count() === 0;
}

public static function canEdit($record): bool
{
    return auth()->user()?->isSuperAdmin() === true
        || auth()->user()?->isOwner() === true;
}

public static function canDelete($record): bool
{
    return false;
}

public static function canDeleteAny(): bool
{
    return false;
}

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSettings::route('/'),
            'create' => CreateSetting::route('/create'),
            'edit' => EditSetting::route('/{record}/edit'),
        ];
    }

    protected static ?string $navigationLabel = 'Configuración';

protected static ?string $modelLabel = 'configuración';

protected static ?string $pluralModelLabel = 'configuración';

protected static string|\UnitEnum|null $navigationGroup = 'Sistema';

protected static ?int $navigationSort = 1;
}
