<?php

namespace App\Http\Controllers\api\v1;

use App\Helpers\BannerLogic;
use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
   
public function banners(Request $request)
{
    try {
        $banners = BannerLogic::get_banners();

        return response()->json(['campaigns' => [], 'banners' => $banners], 200);
    } catch (\Exception $e) {
        return response()->json([], 200);
    }
}



}
