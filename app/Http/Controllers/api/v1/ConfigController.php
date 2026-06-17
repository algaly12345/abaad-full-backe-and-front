<?php

namespace App\Http\Controllers\api\v1;

use App\Helpers\EstateManager;
use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\BusinessSetting;
use App\Models\Estate;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use App\Models\Place;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use MatanYadaev\EloquentSpatial\Objects\Point;
use MatanYadaev\EloquentSpatial\SpatialBuilder;

use MatanYadaev\EloquentSpatial\Objects\Polygon;
use MatanYadaev\EloquentSpatial\Traits\HasSpatial;

class ConfigController extends Controller
{

    private $map_api_key;

    function __construct()
    {
        $map_api_key_server = BusinessSetting::where(['type' => 'map_api_key'])->first();
        $map_api_key_server = $map_api_key_server ? $map_api_key_server->value : null;
        $this->map_api_key = $map_api_key_server;
    }

    public function configuration()
    {
        $languages = Helpers::get_business_settings('pnc_language');
        $lang_array = [];
        foreach ($languages as $language) {
            array_push($lang_array, [
                'code' => $language,
                'name' => Helpers::get_language_name($language)
            ]);
        }


        $business_plan = [
            'commission' => 1,
            'subscription' => 1,
        ];
        return response()->json([
            'business_name' => BusinessSetting::where('type', 'company_name')->first()->value,
            'logo' => BusinessSetting::where('type', 'company_mobile_logo')->first()->value,
            'address' => BusinessSetting::where('type', 'company_phone')->first()->value,
            'phone' => BusinessSetting::where('type', 'company_phone')->first()->value,
            'email' => BusinessSetting::where('type', 'company_email')->first()->value,
            'customer_verification' => true,
            'business_plan' => $business_plan,
            'marketing_commission' => 2.5,
            'agent_registration' => 1,
            'currency_symbol' =>'SR',
            'digit_after_decimal_point' =>0,
            'base_urls' => [
                'estate_image_url' => EstateManager::estate_image_path('estate'),
                'category_image_url' => asset('storage/app/public/categories'),
                'customer_image_url' => asset('storage/app/public/profile'),
                'planed' => asset('storage/app/public/planed'),
                'review_image_url' => asset('storage/app/public'),
                'agent_image_url' => asset('storage/app/public/agent'),
                'activities_image_url' => asset('storage/app/public/activities'),
                'provider_image_url' => asset('storage/app/public'),
                'banners' => asset('storage/app/public/banner'),
                'notification_image_url' => asset('storage/app/public/notification'),
                'chat_image_url'=> asset('storage/app/public/conversation')
            ],
            'about_us' => Helpers::get_business_settings('about_us'),
            'about_us_ar' => Helpers::get_business_settings('about_us_ar'),
            'privacy_policy' => Helpers::get_business_settings('privacy_policy'),
               'privacy_policy_ar' => Helpers::get_business_settings('privacy_policy_ar'),
               
                'app_url_ios' => 'https://apps.apple.com/fi/app/%D8%A7%D8%A8%D8%B9%D8%A7%D8%AF-%D8%A7%D9%84%D8%B9%D9%82%D8%A7%D8%B1%D9%8A%D8%A9/id6470352371',
               
            'terms_conditions' => Helpers::get_business_settings('terms_condition'),
            'terms_condition_ar' => Helpers::get_business_settings('terms_condition_ar'),
            'feature_ar' => Helpers::get_business_settings('feature_ar'),
            'feature' => Helpers::get_business_settings('feature'),
            'app_minimum_version_android' => 7.0,
            'app_minimum_version_ios' => 7.0,
            'app_url_android' => "ffdgfdgfdg",
            'admin_commission' => (float)(Helpers::get_business_settings('admin_commission') ? Helpers::get_business_settings('admin_commission') : 0),
            'language' => $lang_array,
            'default_location' => ['lat' => '23.757989', 'lng' => '90.360587'],
            'email_verification' => (boolean)Helpers::get_business_settings('email_verification'),
            'phone_verification' => (boolean)Helpers::get_business_settings('phone_verification'),
            'country' => Helpers::get_business_settings('country_code'),
            'demo' => (bool)(env('APP_MODE') == 'demo' ? true : false),
            'free_trial_period_status' => (int)(isset($settings['free_trial_period']) ? json_decode($settings['free_trial_period'], true)['status'] : 0),
            'free_trial_period_data' => (int)(isset($settings['free_trial_period']) ? json_decode($settings['free_trial_period'], true)['data'] : 0),
            'maintenance_mode' => false,
            
            'google_map_key' => 'AIzaSyAwM15LYUky7qqVuXdBQc9zavA39y487jQ',


        ]);
    }


    public function place_api_autocomplete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'search_text' => 'required',
        ]);

        if ($validator->errors()->count() > 0) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }
        $response = Http::get('https://maps.googleapis.com/maps/api/place/autocomplete/json?input=' . $request['search_text'] . '&key=AIzaSyAFuZIjGVfo57sJk3EmCSV0SpP7qVgg7n4');
        return $response->json();
    }


    public function place_api_details(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'placeid' => 'required',
        ]);

        if ($validator->errors()->count() > 0) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }
        $response = Http::get('https://maps.googleapis.com/maps/api/place/details/json?placeid=' . $request['placeid'] . '&key=AIzaSyAFuZIjGVfo57sJk3EmCSV0SpP7qVgg7n4');
        return $response->json();
    }


    public function get_zone(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'lat' => 'required',
            'lng' => 'required',
        ]);

        if ($validator->errors()->count() > 0) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }
        $point = new Point($request->lat, $request->lng);

//        $zones = Zone::query()
//            ->whereCoordinates('coordinates', $point)->latest()->get(['id', 'status']);

        $address= mb_strimwidth($request->address, 0, 8, '');
     //   return Str::limit($request->address,8);
        $user = Estate::where('national_address',$address)->first();

        if ($user) {
            return response()->json([
                'errors' => [
                    ['code' => 'coordinates', 'message' => 'messages.service_not_available_in_this_area']
                ]
            ], 404);
        }
//        $data = array_filter($zones->toArray(), function ($zone) {
//            if ($zone['status'] == 1) {
//                return $zone;
//            }
//        });

//        if (count($data) > 0) {
//            return response()->json(['zone_id' => json_encode(array_column($data, 'id')), 'zone_data'=>array_values($data)], 200);
//        }


//        return  response()->json(array("success"=>"true","token"=>'fdsf'))
        return response()->json([
            'zone_id'=>'[1,2]',
            'zone_data' => [
                ['id' => 2, 'status' => 1,'minimum_shipping_charge'=>20,'per_km_shipping_charge'=>30],
                ['id' => 2, 'status' => 1,'minimum_shipping_charge'=>20,'per_km_shipping_charge'=>30]
            ]
        ], 200);
    }




    public function geocode_api(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'lat' => 'required',
            'lng' => 'required',
        ]);

        if ($validator->errors()->count() > 0) {
            return response()->json(['errors' =>Helpers::error_processor($validator)], 403);
        }
        $response = Http::get('https://maps.googleapis.com/maps/api/geocode/json?latlng=' . $request->lat . ',' . $request->lng . '&key=AIzaSyAFuZIjGVfo57sJk3EmCSV0SpP7qVgg7n4');
        return $response->json();
    }


}
