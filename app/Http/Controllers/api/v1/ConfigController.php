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

        // نفس مصدر رابط R2 العام اللي تتحكم فيه من لوحة Spring (Settings -> Media Storage)
        $r2PublicUrl = getWebConfig('r2_public_url');
        $r2Base = $r2PublicUrl ? rtrim($r2PublicUrl, '/') : '';

        $googleStoreSetting = BusinessSetting::where('type', 'download_app_google_stroe')->first();
        $googleStoreData = $googleStoreSetting ? json_decode($googleStoreSetting->value, true) : [];
        $appleStoreSetting = BusinessSetting::where('type', 'download_app_apple_stroe')->first();
        $appleStoreData = $appleStoreSetting ? json_decode($appleStoreSetting->value, true) : [];

        $mapApiKeySetting = BusinessSetting::where('type', 'map_api_key')->first();

        return response()->json([
            'business_name' => optional(BusinessSetting::where('type', 'company_name')->first())->value,
            'logo' => optional(BusinessSetting::where('type', 'company_mobile_logo')->first())->value,
            'address' => optional(BusinessSetting::where('type', 'company_phone')->first())->value,
            'phone' => optional(BusinessSetting::where('type', 'company_phone')->first())->value,
            'email' => optional(BusinessSetting::where('type', 'company_email')->first())->value,
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
            ],
            'about_us' => Helpers::get_business_settings('about_us'),
            'about_us_ar' => Helpers::get_business_settings('about_us_ar'),
            'privacy_policy' => Helpers::get_business_settings('privacy_policy'),
            'privacy_policy_ar' => Helpers::get_business_settings('privacy_policy_ar'),

            'app_url_ios' => $appleStoreData['link'] ?? '',
            'app_url_android' => $googleStoreData['link'] ?? '',

            'terms_conditions' => Helpers::get_business_settings('terms_condition'),
            'terms_condition_ar' => Helpers::get_business_settings('terms_condition_ar'),
            'feature_ar' => Helpers::get_business_settings('feature_ar'),
            'feature' => Helpers::get_business_settings('feature'),
            'app_minimum_version_android' => (float)(Helpers::get_business_settings('app_min_version_android') ?: 1.0),
            'app_minimum_version_ios' => (float)(Helpers::get_business_settings('app_min_version_ios') ?: 1.0),
            'admin_commission' => (float)(Helpers::get_business_settings('admin_commission') ?: 0),
            'language' => $lang_array,
            'default_location' => ['lat' => '23.757989', 'lng' => '90.360587'],
            'email_verification' => (boolean)Helpers::get_business_settings('email_verification'),
            'phone_verification' => (boolean)Helpers::get_business_settings('phone_verification'),
            'country' => Helpers::get_business_settings('country_code'),
            'demo' => (bool)(env('APP_MODE') == 'demo'),
            'free_trial_period_status' => (int)(isset($settings['free_trial_period']) ? json_decode($settings['free_trial_period'], true)['status'] : 0),
            'free_trial_period_data' => (int)(isset($settings['free_trial_period']) ? json_decode($settings['free_trial_period'], true)['data'] : 0),
            'maintenance_mode' => Helpers::get_business_settings('maintenance_mode') == '1',

            'google_map_key' => $mapApiKeySetting ? $mapApiKeySetting->value : '',
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
