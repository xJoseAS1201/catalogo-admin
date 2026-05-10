<?php

namespace App\Filament\Resources\Categories;

use App\Filament\Resources\Categories\Pages\CreateCategory;
use App\Filament\Resources\Categories\Pages\EditCategory;
use App\Filament\Resources\Categories\Pages\ListCategories;
use App\Filament\Resources\Categories\Schemas\CategoryForm;
use App\Filament\Resources\Categories\Tables\CategoriesTable;
use App\Models\Category;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return CategoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CategoriesTable::configure($table);
    }

    public static function canViewAny(): bool
{
    return auth()->user()?->is_active === true;
}

public static function canCreate(): bool
{
    return auth()->user()?->is_active === true;
}

public static function canEdit($record): bool
{
    return auth()->user()?->is_active === true;
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
            'index' => ListCategories::route('/'),
            'create' => CreateCategory::route('/create'),
            'edit' => EditCategory::route('/{record}/edit'),
        ];
    }

    protected static ?string $navigationLabel = 'Categorías';

protected static ?string $modelLabel = 'categoría';

protected static ?string $pluralModelLabel = 'categorías';

protected static string|\UnitEnum|null $navigationGroup = 'Catálogo';

protected static ?int $navigationSort = 1;
}
