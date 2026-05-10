<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Http\Request;

class PublicCatalogController extends Controller
{
    public function home()
    {
        $settings = Setting::first();

        $categories = Category::where('is_active', true)
            ->latest()
            ->take(6)
            ->get();

        $featuredProducts = Product::with('category')
            ->where('is_active', true)
            ->where('is_featured', true)
            ->latest()
            ->take(6)
            ->get();

        return view('public.home', compact(
            'settings',
            'categories',
            'featuredProducts'
        ));
    }

    public function catalog(Request $request)
    {
        $settings = Setting::first();

        $categories = Category::where('is_active', true)
            ->orderBy('name')
            ->get();

        $products = Product::with('category')
            ->where('is_active', true)
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
            })
            ->when($request->filled('category'), function ($query) use ($request) {
                $query->whereHas('category', function ($categoryQuery) use ($request) {
                    $categoryQuery->where('slug', $request->category);
                });
            })
            ->when($request->filled('stock_status'), function ($query) use ($request) {
                $query->where('stock_status', $request->stock_status);
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('public.catalog', compact(
            'settings',
            'categories',
            'products'
        ));
    }

    public function show(Product $product)
    {
        if (!$product->is_active) {
            abort(404);
        }

        $settings = Setting::first();

        $product->load('category', 'images');

        return view('public.show', compact(
            'settings',
            'product'
        ));
    }
}
