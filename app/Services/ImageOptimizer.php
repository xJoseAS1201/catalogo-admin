<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class ImageOptimizer
{
    public static function convertToWebp(
        ?string $path,
        string $directory,
        int $maxWidth = 1200,
        int $quality = 80
    ): ?string {
        if (blank($path)) {
            return $path;
        }

        $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));

        // Si ya es webp, no lo reprocesamos.
        if ($extension === 'webp') {
            return $path;
        }

        // Solo convertimos imágenes comunes.
        if (! in_array($extension, ['jpg', 'jpeg', 'png'], true)) {
            return $path;
        }

        $disk = Storage::disk('public');

        if (! $disk->exists($path)) {
            return $path;
        }

        try {
            $absolutePath = $disk->path($path);

            $image = Image::read($absolutePath)
                ->scaleDown(width: $maxWidth);

            $newPath = trim($directory, '/') . '/' . Str::uuid() . '.webp';

            // Esta línea fuerza la salida en formato WebP real.
            $webpImage = $image->toWebp(quality: $quality);

            $disk->put($newPath, (string) $webpImage);

            // Borramos el JPG/PNG original.
            $disk->delete($path);

            return $newPath;
        } catch (\Throwable $exception) {
            Log::error('Error optimizando imagen', [
                'path' => $path,
                'message' => $exception->getMessage(),
            ]);

            return $path;
        }
    }
}
