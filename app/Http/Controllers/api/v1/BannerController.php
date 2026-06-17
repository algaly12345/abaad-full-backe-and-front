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

            $zone_id =$request->zone_id;
            $banners = BannerLogic::get_banners($zone_id);
            $campaigns = Advertisement::whereHas('providers', function($query)use($request){
                $query->where('zone_id', $request->zone_id);
            })->with('providers',function($query)use($request){
                return $query->where('zone_id', $request->zone_id);
            })->get();



            return response()->json(['campaigns'=>Helpers::basic_campaign_data_formatting($campaigns, true),'banners'=>$banners], 200);
        } catch (\Exception $e) {
            return response()->json([], 200);
        }
    }
}
