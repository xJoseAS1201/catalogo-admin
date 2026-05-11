<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total de productos', Product::count())
                ->description('Productos registrados en el catálogo')
                ->color('info'),

            Stat::make('Productos visibles', Product::where('is_active', true)->count())
                ->description('Productos activos para clientes')
                ->color('success'),

            Stat::make('Productos destacados', Product::where('is_featured', true)->count())
                ->description('Productos mostrados como destacados')
                ->color('warning'),

            Stat::make('Categorías activas', Category::where('is_active', true)->count())
                ->description('Categorías disponibles en el catálogo')
                ->color('success'),
        ];
    }
}
