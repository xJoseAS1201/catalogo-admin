<?php

use App\Http\Controllers\PublicCatalogController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicCatalogController::class, 'home'])->name('home');

Route::get('/catalogo', [PublicCatalogController::class, 'catalog'])->name('catalog');

Route::get('/producto/{product}', [PublicCatalogController::class, 'show'])->name('products.show');
