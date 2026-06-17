<?php

namespace App\Helpers;


use App\Models\Banner;
use App\Models\ServiceProvider;

class BannerLogic
{
    public static function get_banners($zone_id)
    {
//        if($zone_id!=null){
//            $banners = Banner::active()->where('zone_id', $zone_id)->get();
//        }else{
//            $banners = Banner::active()->get();
//        }
//
//        return $banners;

        $banners = Banner::active()->where('zone_id', $zone_id)->get();

        $data = [];
        foreach($banners as $banner)
        {
//                $serviceProvider = ServiceProvider::find(1);
                $data[]=[
                    'id'=>$banner->id,
                    'title'=>$banner->title,
                    'type'=>$banner->type,
                    'image'=>$banner->image,
                    'restaurant'=>null,
                    'food'=>null
                ];

        }
        return $data;
    }
}
