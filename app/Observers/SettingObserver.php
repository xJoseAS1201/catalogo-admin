<?php

namespace App\Observers;

use App\Models\Setting;
use App\Services\ImageOptimizer;

class SettingObserver
{
    public function saved(Setting $setting): void
    {
        if (blank($setting->logo)) {
            return;
        }

        $optimizedPath = ImageOptimizer::convertToWebp(
            path: $setting->logo,
            directory: 'logos',
            maxWidth: 700,
            quality: 85
        );

        if ($optimizedPath !== $setting->logo) {
            $setting->updateQuietly([
                'logo' => $optimizedPath,
            ]);
        }
    }
}
