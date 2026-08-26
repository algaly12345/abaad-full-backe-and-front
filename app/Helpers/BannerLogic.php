<?php

namespace App\Helpers;

use App\Models\Banner;
use App\Models\ServiceProvider;

class BannerLogic
{
    public static function get_banners($zone_id = null)
    {
        // تم حذف قيد المنطقة (zone_id) بالكامل — البانرات دلوقتي بترجع
        // كلها بغض النظر عن المنطقة، بدل ما تتقيّد بمنطقة معيّنة.
        $banners = Banner::active()->get();

        $data = [];
        foreach ($banners as $banner) {
            $data[] = [
                'id' => $banner->id,
                'title' => $banner->title,
                'type' => $banner->type,
                'image' => $banner->image,
                'restaurant' => null,
                'food' => null,
            ];
        }

        return $data;
    }
}