<?php

namespace App\Helpers;

use App\Models\BusinessSetting;
use App\Models\Estate;
use App\Models\SubscriptionPackages;
use App\Models\SubscriptionTransactions;
use App\Models\User;
use App\Models\usersSubscriptions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class Helpers
{
    public static function status($id)
    {
        if ($id == 1) {
            $x = 'active';
        } elseif ($id == 0) {
            $x = 'in-active';
        }

        return $x;
    }


    public static function update(string $dir, $old_image, string $format, $image = null)
    {
        if ($image == null) {
            return $old_image;
        }
        if (Storage::disk('public')->exists($dir . $old_image)) {
            Storage::disk('public')->delete($dir . $old_image);
        }
        $imageName = Helpers::upload($dir, $format, $image);
        return $imageName;
    }




    public static function get_business_settings($name)
    {
        $config = null;
        $check = ['language', 'company_name'];

        if (in_array($name, $check) == true && session()->has($name)) {
            $config = session($name);
        } else {
            $data = BusinessSetting::where(['type' => $name])->first();
            if (isset($data)) {
                $config = json_decode($data['value'], true);
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


    public static function generate_referer_code($user)
    {
        $user_name = $user_name = explode('@', $user->email)[0];
        $user_id = $user->id;
        //dd($user_id);
        $uid_length = strlen($user->id);
        if (strlen($user_name) > 10 - $uid_length) {
            $user_name = substr($user_name, 0, 10 - $uid_length);
        } elseif (strlen($user_name) < 10 - $uid_length) {
            $user_id = $user_id * pow(10, ((10 - $uid_length) - strlen($user_name)));
        }
        return $user_name . $user_id;
    }




    public static function error_processor($validator)
    {
        $err_keeper = [];
        foreach ($validator->errors()->getMessages() as $index => $error) {
            array_push($err_keeper, ['code' => $index, 'message' => $error[0]]);
        }
        return $err_keeper;
    }


    public static function get_language_name($key)
    {
        $values = Helpers::get_business_settings('language');
        foreach ($values as $value) {
            if ($value['code'] == $key) {
                $key = $value['name'];
            }
        }

        return $key;
    }



    public static function basic_campaign_data_formatting($data, $multi_data = false)
    {
        $storage = [];
        if ($multi_data == true) {
            foreach ($data as $item) {
                $variations = [];

                if ($item->start_date) {
                    $item['available_date_starts'] = $item->start_date->format('Y-m-d');
                    unset($item['start_date']);
                }
                if ($item->end_date) {
                    $item['available_date_ends'] = $item->end_date->format('Y-m-d');
                    unset($item['end_date']);
                }


                array_push($storage, $item);
            }
            $data = $storage;
        } else {
            if ($data->start_date) {
                $data['available_date_starts'] = $data->start_date->format('Y-m-d');
                unset($data['start_date']);
            }
            if ($data->end_date) {
                $data['available_date_ends'] = $data->end_date->format('Y-m-d');
                unset($data['end_date']);
            }

            if (count($data['translations']) > 0) {
                $translate = array_column($data['translations']->toArray(), 'value', 'key');
                $data['title'] = $translate['title'];
                $data['description'] = $translate['description'];
            }
        }

        return $data;
    }


    public static function upload(string $dir, string $format, $image = null)
    {
        if ($image != null) {
            $imageName =Carbon::now()->toDateString() . "-" . uniqid() . "." . $format;
            if (!Storage::disk('public')->exists($dir)) {
                Storage::disk('public')->makeDirectory($dir);
            }
            Storage::disk('public')->put($dir . $imageName, file_get_contents($image));
            return $imageName;
        }
        // else {
        // $imageName = 'def.png';
        // }
        //return $imageName;
    }


    /**
     * ملاحظة: كانت هذه الدالة تستدعي Legacy FCM HTTP API
     * (https://fcm.googleapis.com/fcm/send) التي أوقفتها Google نهائيًا في
     * يونيو 2024 (ترجع 404 دائمًا بغض النظر عن صحة المفتاح). استُبدل التنفيذ
     * الداخلي بـ FCM v1 عبر App\Services\FcmV1Service مع إبقاء نفس التوقيع
     * (٣ معاملات) حتى لا تحتاج نقاط الاستدعاء الحالية أي تعديل.
     */
    public static function send_push_notif_to_topic($data, $topic, $type)
    {
        $payload = $data;
        $payload['type'] = $payload['type'] ?? $type;
        $payload['is_read'] = $payload['is_read'] ?? 0;

        return \App\Services\FcmV1Service::sendToTopic(
            $topic,
            $payload,
            $data['title'] ?? null,
            $data['description'] ?? null,
            $data['image'] ?? null
        );
    }



    public static function subscription_plan_chosen($estate_id, $package_id)
    {
        $estate=Estate::findOrFail($estate_id);
        $package = SubscriptionPackages::findOrFail($package_id);




        try {
            $subscription_transaction= new SubscriptionTransactions();
            $subscription_transaction->id= Str::uuid();
            $subscription_transaction->package_id=$package->id;
            $subscription_transaction->estate_id=$estate->id;
            $subscription_transaction->price=$package->price;


//

            DB::beginTransaction();

            $subscription_transaction->save();

            DB::commit();
        } catch(\Exception $e) {
            DB::rollBack();
            info(["line___{$e->getLine()}",$e->getMessage()]);
            return false;
        }
        return true;
    }


    public static function wishlist_data_formatting($data)
    {
        EstateLogic::estate_data_formatting($data);

        return $data;
        foreach ($data as $item) {
            return $item["estate"]->id;
        }
        return $data;
    }

    public static function format_coordiantes($coordinates)
    {
        $data = [];
        foreach (collect($coordinates)['coordinates'] as $coord) {
            $data[] = (object)['lat' => $coord[1], 'lng' => $coord[0]];
        }
        return $data;
    }


    /**
     * ملاحظة: كانت هذه الدالة تستدعي Legacy FCM HTTP API (نفس السبب الموضّح
     * أعلى send_push_notif_to_topic). استُبدل التنفيذ الداخلي بـ FCM v1 عبر
     * App\Services\FcmV1Service مع إبقاء نفس التوقيع (٣ معاملات، $web_push_link
     * اختياري) حتى لا تحتاج نقاط الاستدعاء الحالية أي تعديل.
     */
    public static function send_push_notif_to_device($fcm_token, $data, $web_push_link = null)
    {
        $payload = [
            'order_id' => $data['order_id'] ?? '',
            'type' => $data['type'] ?? '',
            'conversation_id' => $data['conversation_id'] ?? '',
            'sender_type' => $data['sender_type'] ?? '',
            'order_type' => $data['order_type'] ?? '',
            'is_read' => 0,
        ];
        if ($web_push_link) {
            $payload['click_action'] = $web_push_link;
        }

        return \App\Services\FcmV1Service::sendToToken(
            $fcm_token,
            $payload,
            $data['title'] ?? null,
            $data['description'] ?? null,
            $data['image'] ?? null
        );
    }





    public static function get_settings($object, $type)
    {
        $config = null;
        foreach ($object as $setting) {
            if ($setting['type'] == $type) {
                $config = $setting;
            }
        }
        return $config;
    }



    public static function language_load()
    {
        if (\session()->has('language_settings')) {
            $language = \session('language_settings');
        } else {
            $language = BusinessSetting::where('type', 'language')->first();
            \session()->put('language_settings', $language);
        }
        return $language;
    }



}
