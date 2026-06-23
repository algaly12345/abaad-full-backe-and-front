<?php

namespace App\Http\Controllers\api\v1\auth;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\PhoneOrEmailVerification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CustomerAuthController extends Controller
{
    // 1. تسجيل الدخول المحسن والكامل
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required',
            'password' => 'required|min:6'
        ], [
            'phone.required' => 'رقم الجوال مطلوب',
            'password.required' => 'كلمة المرور مطلوبة',
            'password.min' => 'كلمة المرور يجب أن لا تقل عن 6 أحرف'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }

        $phone = $request->phone;
        if (preg_match('/^0?5\d{8}$/', $phone)) {
            $phone = '+966' . ltrim($phone, '0');
        } elseif (preg_match('/^5\d{8}$/', $phone)) {
            $phone = '+966' . $phone;
        }

        $user = User::where('phone', $phone)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'errors' => [['code' => 'auth-001', 'message' => 'رقم الجوال أو كلمة المرور غير صحيحة']]
            ], 401);
        }

        if ($user->is_active == 'disactive' || $user->is_active == 0) {
            return response()->json([
                'errors' => [['code' => 'auth-003', 'message' => 'عفواً، تم حظر حسابك']]
            ], 403);
        }

        if (!$user->is_phone_verified) {
            $otp = rand(1000, 9999);

            DB::table('phone_or_email_verifications')->updateOrInsert(
                ['phone_or_email' => $user->phone],
                [
                    'token' => $otp,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );

            $msg = 'مرحبا، كود تفعيل رقمك الخاص هو: ' . $otp;
            $this->sendSMS($user->phone, $msg);
        }

        if (empty($user->ref_code)) {
            $user->ref_code = Helpers::generate_referer_code($user);
            $user->save();
        }

        if ($user->user_type == 'customer') {
            Agent::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'name' => $user->name, 
                    'phone' => $user->phone, 
                    'agent_type' => 'فرد', 
                    'membership_type' => 'customer'
                ]
            );
        }

        if ($user->user_type == 'agent') {
            $user->load('agent');
        } elseif ($user->user_type == 'provider') {
            $user->load('provider');
        }

        $token = $user->createToken('LaravelAuthApp')->accessToken;

        return response()->json([
            'status' => true,
            'message' => 'تم تسجيل الدخول بنجاح',
            'token' => $token,
            'is_phone_verified' => $user->is_phone_verified,
            'user' => $user
        ], 200);
    }

    // 2. التحقق من رقم الجوال (Verify OTP)
    public function verify_phone(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required',
            'otp'=>'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }

        $phone = $request->phone;
        if (preg_match('/^0?5\d{8}$/', $phone)) {
            $phone = '+966' . ltrim($phone, '0');
        } elseif (preg_match('/^5\d{8}$/', $phone)) {
            $phone = '+966' . $phone;
        }

        $user = User::where('phone', $phone)->first();
        if($user)
        {
            if($user->is_phone_verified)
            {
                return response()->json([
                    'message' => 'رقم الجوال موثق بالفعل'
                ], 200);
            }

            if(env('APP_MODE')=='demos')
            {
                if($request['otp']=="1234")
                {
                    $user->is_phone_verified = 1;
                    $user->save();

                    return response()->json([
                        'message' => 'تم التحقق من رقم الجوال بنجاح',
                        'otp' => 'inactive'
                    ], 200);
                }
                return response()->json([
                    'message' => 'رقم الجوال ورمز التحقق غير متطابقين'
                ], 404);
            }

            $data = DB::table('phone_or_email_verifications')->where([
                'phone_or_email' => $user->phone,
                'token' => $request['otp'],
            ])->first();

            if($data)
            {
                DB::table('phone_or_email_verifications')->where([
                    'phone_or_email' => $user->phone,
                    'token' => $request['otp'],
                ])->delete();

                $user->is_phone_verified = 1;
                $user->save();

                return response()->json([
                    'message' => 'تم التحقق من رقم الجوال بنجاح',
                    'otp' => 'inactive'
                ], 200);
            }
            else{
                return response()->json([
                    'errors' => [['code' => 'otp', 'message' => 'رمز التحقق غير صحيح أو منتهي الصلاحية']]
                ], 403);
            }
        }
        return response()->json([
            'errors' => [['code' => 'phone', 'message' => 'رقم الجوال المطلوب غير موجود']]
        ], 404);
    }

    // 3. التسجيل للمستخدم الجديد (Register)
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required|unique:users',
        ], [
            'name.required' => 'الإسم غير موجود'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
            'zone_id'=>$request->zone_id,
            'user_type'=>'customer',
            'membership_type'=>$request->membership_type,
            'unified_number'=>$request->unified_number,
        ]);
        $user->ref_code = Helpers::generate_referer_code($user);
        $user->save();

        $token = $user->createToken('LaravelAuthApp')->accessToken;

        $otp = rand(1000, 9999);
        DB::table('phone_or_email_verifications')->updateOrInsert(['phone_or_email' => $request['phone']],
            [
                'token' => $otp,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

        try {
            Agent::create([
                'name'=>$user->name,
                'phone'=>$user->phone,
                'agent_type' => 'فرد',
                'membership_type' => 'customer',
                'user_id' => $user->id,
            ]);
        } catch (\Exception $ex) {
            info('Agent create on register failed for user ' . $user->id . ': ' . $ex->getMessage());
        }

        $msg = 'مرحبا كود تفعيل رقمك الخاص هو: ' . $otp;
        $this->sendSMS($user->phone, $msg);
        
        $msgAdmin = "تم تسجيل مستخدم جديد في منصة أبعاد.\nالاسم: " . $user->name . "\nالجوال: " . $user->phone;
        $this->sendSMS("503731637", $msgAdmin);

        return response()->json(['token' => $token,'is_phone_verified' => 0, 'phone_verify_end_url'=>"api/v1/auth/verify-phone" ], 200);
    }

    // 4. جلب الأكواد للاختبارات البرمجية
    public function all_code()
    {
        return response()->json(DB::table('phone_or_email_verifications')->latest()->get());
    }

    // 5. إرسال رسالة SMS بوابة Msegat
    public function sendSMS($phone, $msg)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://www.msegat.com/gw/sendsms.php");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);

        $fields = [
            "userName"   => "Abaad",
            "numbers"    => str_replace('+', '', $phone),
            "userSender" => "ABAAD",
            "apiKey"     => "d98696cc4de689215daa663a3b5efe62",
            "msg"        => $msg
        ];

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($ch);
        curl_close($ch);

        return $server_output;
    }
}