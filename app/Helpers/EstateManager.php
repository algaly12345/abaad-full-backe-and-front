<?php

namespace App\Helpers;

use App\CentralLogics\Helpers;
use Illuminate\Support\Facades\Storage;

class EstateManager
{
    public static function estate_image_path($image_type)
    {
        $path = '';
        if ($image_type == 'thumbnail') {
            $path = asset('storage/app/public/product/thumbnail');
        } elseif ($image_type == 'estate') {
            $path = asset('storage/app/public/estate');
        }
        return $path;
    }


    public static function update(string $dir, $old_image, string $format, $image = null)
    {
        if ($image == null) {
            return $old_image;
        }
        if (Storage::disk('public')->exists($dir . $old_image)) {
            Storage::disk('public')->delete($dir . $old_image);
        }
        $imageName = EstateManager::upload($dir, $format, $image);
        return $imageName;
    }

}
