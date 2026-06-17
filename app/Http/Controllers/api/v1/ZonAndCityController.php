<?php

namespace App\Http\Controllers\api\v1;

use App\Helpers\EstateLogic;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\CityLite;
use App\Models\DistrictLite;
use App\Models\RegionLite;
use App\Models\Zone;
use Illuminate\Http\Request;


class ZonAndCityController extends Controller
{
    public function all()
    {
        try {
            $zones = Zone::where(['status'=>'active'])->withCount(['estate'])->latest()->orderBy('id','desc')->get();
            return response()->json(EstateLogic::category_data_formatting($zones, true), 200);
//            return response()->json($zones, 200);
        } catch (\Exception $e) {
            return response()->json([], 200);
        }
    }


    public function cities_by_zoneId(Request $request)
    {
        try {
            $zones = City::where('zone_id',$request->zone_id)->orderBy('id','desc')->get();


            return response()->json($zones, 200);
        } catch (\Exception $e) {
            return response()->json([], 200);
        }
    }




    public function get_regions()
    {
        try {

            $regions = RegionLite::all();
            return response()->json($regions, 200);
        } catch (\Exception $e) {
            return response()->json([], 200);
        }
    }

    public function get_cities_by_regions($id)
    {
        try {

            $cities = CityLite::where('region_id' , $id)->get();
            return response()->json($cities, 200);
        } catch (\Exception $e) {
            return response()->json([], 200);
        }
    }


    public function get_districts_by_cities($id)
    {
        try {
            $district = DistrictLite::where(['city_id' => $id])->get();
            return response()->json($district, 200);
        } catch (\Exception $e) {
            return response()->json([], 200);
        }
    }
}
