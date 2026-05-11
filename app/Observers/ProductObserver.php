<?php

namespace App\Observers;

use App\Models\Product;
use App\Services\ImageOptimizer;

class ProductObserver
{
    public function saved(Product $product): void
    {
        if (blank($product->main_image)) {
            return;
        }

        $optimizedPath = ImageOptimizer::convertToWebp(
            path: $product->main_image,
            directory: 'products',
            maxWidth: 1200,
            quality: 80
        );

        if ($optimizedPath !== $product->main_image) {
            $product->updateQuietly([
                'main_image' => $optimizedPath,
            ]);
        }
    }
}
