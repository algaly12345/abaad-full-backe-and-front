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
use Illuminate\Support\Facades\Storage;
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
    try {
        // تحميل كل إعدادات business_settings دفعة واحدة بدل استعلام منفصل لكل حقل
        $allSettings = BusinessSetting::all()->keyBy('type');

        $getDecoded = function ($type) use ($allSettings) {
            $setting = $allSettings->get($type);
            if (!$setting) return null;
            $decoded = json_decode($setting->value, true);
            return is_null($decoded) ? $setting->value : $decoded;
        };
        $getRaw = function ($type) use ($allSettings) {
            return optional($allSettings->get($type))->value;
        };

        $languages = $getDecoded('pnc_language');
        $lang_array = [];
        if (is_array($languages)) {
            foreach ($languages as $language) {
                array_push($lang_array, [
                    'code' => $language,
                    'name' => Helpers::get_language_name($language)
                ]);
            }
        }

        $business_plan = [
            'commission' => 1,
            'subscription' => 1,
        ];

        $r2PublicUrl = $getDecoded('r2_public_url');
        $r2Base = $r2PublicUrl ? rtrim($r2PublicUrl, '/') : '';

        $googleStoreData = $getDecoded('download_app_google_stroe') ?: [];
        $appleStoreData = $getDecoded('download_app_apple_stroe') ?: [];

        return response()->json([
            'business_name' => $getRaw('company_name'),
            'logo' => $getRaw('company_mobile_logo'),
            'address' => $getRaw('company_phone'),
            'phone' => $getRaw('company_phone'),
            'email' => $getRaw('company_email'),
            'customer_verification' => true,
            'business_plan' => $business_plan,
            'marketing_commission' => 2.5,
            'agent_registration' => 1,
            'currency_symbol' => 'SR',
            'digit_after_decimal_point' => 0,
            'base_urls' => [
                'estate_image_url' => $r2Base . '/estate',
                'category_image_url' => $r2Base . '/categories',
                'customer_image_url' => $r2Base . '/profile',
                'planed' => $r2Base . '/planed',
                'review_image_url' => $r2Base . '/reviews',
                'agent_image_url' => $r2Base . '/agent',
                'activities_image_url' => $r2Base . '/activities',
                'provider_image_url' => $r2Base . '/providers',
                'banners' => $r2Base . '/banners',
                'notification_image_url' => $r2Base . '/notification',
                'chat_image_url' => $r2Base . '/conversation',
                'zone_image_url' => $r2Base . '/zone',
            ],
            'about_us' => $getDecoded('about_us'),
            'about_us_ar' => $getDecoded('about_us_ar'),
            'privacy_policy' => $getDecoded('privacy_policy'),
            'privacy_policy_ar' => $getDecoded('privacy_policy_ar'),

            'app_url_ios' => $appleStoreData['link'] ?? '',
            'app_url_android' => $googleStoreData['link'] ?? '',

            'terms_conditions' => $getDecoded('terms_condition'),
            'terms_condition_ar' => $getDecoded('terms_condition_ar'),
            'feature_ar' => $getDecoded('feature_ar'),
            'feature' => $getDecoded('feature'),
            'app_minimum_version_android' => (float)($getDecoded('app_min_version_android') ?: 1.0),
            'app_minimum_version_ios' => (float)($getDecoded('app_min_version_ios') ?: 1.0),
            'admin_commission' => (float)($getDecoded('admin_commission') ?: 0),
            'language' => $lang_array,
            'default_location' => ['lat' => '23.757989', 'lng' => '90.360587'],
            'email_verification' => (boolean)$getDecoded('email_verification'),
            'phone_verification' => (boolean)$getDecoded('phone_verification'),
            'country' => $getDecoded('country_code'),
            'demo' => (bool)(env('APP_MODE') == 'demo'),
            'free_trial_period_status' => (int)(isset($settings['free_trial_period']) ? json_decode($settings['free_trial_period'], true)['status'] : 0),
            'free_trial_period_data' => (int)(isset($settings['free_trial_period']) ? json_decode($settings['free_trial_period'], true)['data'] : 0),
            'maintenance_mode' => $getDecoded('maintenance_mode') == '1',

            'google_map_key' => $getRaw('map_api_key') ?: '',
        ]);
    } catch (\Throwable $e) {
        return response()->json(['error' => 'Configuration temporarily unavailable', 'message' => $e->getMessage()], 200);
    }
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
