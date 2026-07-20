<?php

use App\Models\BusinessSetting;
use Illuminate\Support\Facades\Storage;


use Illuminate\Support\Facades\File;

if (!function_exists('translate')) {
    function translate($key)
    {
        $locale = app()->getLocale(); // الحصول على اللغة الحالية
        $path = resource_path("lang/{$locale}/messages.php");

        // التحقق من وجود ملف الترجمة، وإنشائه إذا لم يكن موجودًا
        if (!File::exists($path)) {
            File::put($path, "<?php\n\nreturn [];\n");
        }

        // جلب محتويات ملف الترجمة
        $translations = File::getRequire($path);

        // إذا لم تكن العبارة موجودة، أضفها إلى ملف الترجمة
        if (!array_key_exists($key, $translations)) {
            $translations[$key] = $key;
            File::put($path, '<?php return ' . var_export($translations, true) . ';');
        }

        // إرجاع الترجمة المطلوبة
        return trans("messages.$key");
    }
}


if (!function_exists('theme_asset')) {
    function theme_asset($path) {
        $theme = env('WEB_THEME', 'default');
        return asset("themes/{$theme}/{$path}");
    }
}


if (!function_exists('translate')) {
    function translate($key, $replace = [], $locale = null) {
        return __($key, $replace, $locale);
    }
}
if (!function_exists('getWebConfig')) {
    function getWebConfig($name): string|object|array|null
    {
        $config = null;
        $check = ['currency_model', 'currency_symbol_position', 'system_default_currency', 'language', 'company_name', 'decimal_point_settings', 'product_brand', 'digital_product', 'company_email', 'business_mode', 'storage_connection_type', 'company_web_logo'];

        if (in_array($name, $check) == true && session()->has($name)) {
            $config = session($name);
        } else {
            $data = BusinessSetting::where(['type' => $name])->first();
            if (isset($data)) {
                $arrayOfCompaniesValue = ['company_web_logo', 'company_mobile_logo', 'company_footer_logo', 'company_fav_icon', 'loader_gif'];
                $arrayOfBanner = ['shop_banner', 'offer_banner', 'bottom_banner'];
                $mergeArray = array_merge($arrayOfCompaniesValue, $arrayOfBanner);
                $config = json_decode($data['value'], true);
                if (in_array($name, $mergeArray)) {
                    $folderName = in_array($name, $arrayOfCompaniesValue) ? 'company' : 'shop';
                    $value = isset($config['image_name']) ? $config : ['image_name' => $data['value'], 'storage' => 'public'];
                    $config = storageLink($folderName, $value['image_name'], $value['storage']);
                }
                if (is_null($config)) {
                    $config = $data['value'];
                }
            }
            if (in_array($name, $check) == true) {
                session()->put($name, $config);
            }
        }
        return $config;
    }

    function storageDataProcessing($name, $value)
    {
        $arrayOfCompaniesValue = ['company_web_logo', 'company_mobile_logo', 'company_footer_logo', 'company_fav_icon', 'loader_gif'];
        if (in_array($name, $arrayOfCompaniesValue)) {
            if (!is_array($value)) {
                return storageLink('company', $value, 'public');
            } else {
                return storageLink('company', $value['image_name'], $value['storage']);
            }
        } else {
            return $value;
        }
    }

    function imagePathProcessing($imageData, $path)
    {
        if($imageData){
            $imageData = is_string($imageData) ? $imageData : (array)$imageData;
            $imageArray = [
                'image_name' =>is_array($imageData) ? $imageData['image_name'] : $imageData,
                'storage' => $imageData['storage'] ?? 'public',
            ];
            return storageLink($path, $imageArray['image_name'], $imageArray['storage']);
        }
        return null;
    }

    function storageLink($path, $data, $type): string|array
    {
        if ($type == 's3' && config('filesystems.disks.default') == 's3') {
            $fullPath = ltrim($path . '/' . $data, '/');
            if (fileCheck(disk: 's3', path: $fullPath) && !empty($data)) {
                return [
                    'key' => $data,
                    'path' => Storage::disk('s3')->url($fullPath),
                    'status' => 200,
                ];
            }
        } else {
            if (fileCheck(disk: 'public', path: $path . '/' . $data) && !empty($data)) {
                return [
                    'key' => $data,
                    'path' => Storage::disk('public')->url($path . '/' . $data),
                    'status' => 200,
                ];
            }
        }
        return [
            'key' => $data,
            'path' => null,
            'status' => 404,
        ];
    }
    function storageLinkForGallery($path, $type): string|null
    {
        if ($type == 's3' && config('filesystems.disks.default') == 's3') {
            $fullPath = ltrim($path, '/');
            if (fileCheck(disk: 's3', path: $fullPath)) {
                return Storage::disk('s3')->url($fullPath);
            }
        } else {
            if (fileCheck(disk: 'public', path: $path) ) {
                return Storage::disk('public')->url($path);
            }
        }
        return null;
    }
    function fileCheck($disk, $path): bool
    {
        return Storage::disk($disk)->exists($path);
    }
}
