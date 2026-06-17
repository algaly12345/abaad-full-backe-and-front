<?php

namespace App\Http\Controllers\Customer\Auth;

use App\Events\EmailVerificationEvent;
use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\CustomerRegistrationRequest;
use App\Models\Agent;
use App\Models\BusinessSetting;
use App\Models\PhoneOrEmailVerification;
use App\Models\ServiceType;
use App\Models\Wishlist;
use App\Traits\EmailTemplateTrait;
use App\Models\User;
use App\Utils\CartManager;
use App\Utils\SMS_module;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Modules\Gateways\Traits\SmsGateway;

class RegisterController extends Controller
{
    // use EmailTemplateTrait;
    private $user;
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->middleware('guest:customer', ['except' => ['logout']]);
    }

    public function register()
    {
        session()->put('keep_return_url', url()->previous());

        return view('web-views.customer-views.auth.register');
    }


    public function provider()
    {
        
        session()->put('keep_return_url', url()->previous());
        $serviceTypes = ServiceType::query()->select('id', 'name')->get();

        return view('web-views.customer-views.auth.provider',compact('serviceTypes'));
    }


    public function about_provider()
    {

       
        session()->put('keep_return_url', url()->previous());
        $serviceTypes = ServiceType::query()->select('id', 'name')->get();

        return view('web-views.customer-views.auth.about_provider',compact('serviceTypes'));
    }




    

    public static function check($id)
    {
        $phone_verification = Helpers::get_business_settings('phone_verification');
        $email_verification = Helpers::get_business_settings('email_verification');

        $user = User::find($id);
        if($phone_verification){
            $user_verify = $user->is_phone_verified == 1 ? 1 : 0;
        }elseif($email_verification){
            $user_verify = $user->is_email_verified == 1 ? 1 : 0;
        }

        $token = PhoneOrEmailVerification::where('phone_or_email','=',$user['email'])->first();
        if($token){
            $otp_resend_time = Helpers::get_business_settings('otp_resend_time') > 0 ? Helpers::get_business_settings('otp_resend_time') : 0;
            $token_time = Carbon::parse($token->created_at);
            $convert_time = $token_time->addSeconds($otp_resend_time);
            $get_time = $convert_time > Carbon::now() ? Carbon::now()->diffInSeconds($convert_time) : 0;
        }else{
            $get_time = 0;
        }

        $user_id=$id;

        return view(VIEW_FILE_NAMES['customer_auth_verify'], compact('user','user_verify','get_time','user_id'));
    }

    public function submit(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'f_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'user_id' => 'required|digits_between:9,10|unique:users,phone',
             'user_type' => 'required',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {
            // تنسيق رقم الهاتف بإضافة +966
            $phone_number = "+966" . ltrim($request['user_id'], '0'); // إزالة الصفر الأول إن وجد


$exists = User::where('phone', $phone_number)->exists();

if ($exists) {
       return redirect()->back()->with('error', 'رقم الجوال مستخدم من قبل');
    
}
            // إنشاء المستخدم
            $user = User::create([
                'name' => $request['f_name'],
                'email' => $request['email'],
                'phone' => $phone_number,
                'is_active' => 1,
                'password' => bcrypt("1234567"),
                'zone_id' => "3",
                'user_type' => 'customer',
                'membership_type' => $request['user_type'], // تخزين نوع المستخدم هنا
                'unified_number'=>$request['unified_number'],
            ]);



            // تحقق من إعدادات التحقق
            $phoneVerification = getWebConfig('phone_verification');
            $emailVerification = getWebConfig('email_verification');

            // توليد رمز OTP عشوائي من 6 أرقام
            $new_token_generate = rand(1000, 9999);

            // التحقق من وجود رمز مسبق بناءً على رقم الهاتف
            $token = PhoneOrEmailVerification::where('phone_or_email', $phone_number)->first();

            if ($token) {
                $token->update([
                    'token' => $new_token_generate,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } else {
                PhoneOrEmailVerification::create([
                    'phone_or_email' => $phone_number,
                    'token' => $new_token_generate,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // إرسال رسالة OTP عبر SMS
            $msg = 'مرحبا ' . $request->f_name . '، كود تفعيل رقمك هو: ' . $new_token_generate;

            $fields = json_encode([
                "userName" => "Abaad",
                "numbers" => $phone_number,
                "userSender" => "ABAAD",
                "apiKey" => "d98696cc4de689215daa663a3b5efe62",
                "msg" => $msg
            ]);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://www.msegat.com/gw/sendsms.php");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);

            $server_output = curl_exec($ch);
            curl_close($ch);

            // إعادة التوجيه إلى شاشة التحقق
            // return response()->json([
            //     'status' => 1,
            //     'message' => 'تم التسجيل بنجاح! يرجى التحقق من OTP.',
            //     'redirect_url' => route('customer.auth.check', [$user->id]),
            // ]);


            return redirect(route('customer.auth.verify-register', [$user->id]));

        } catch (\Exception $e) {
            \Log::error('خطأ في تسجيل المستخدم: ' . $e->getMessage());
            return response()->json([
                'status' => 0,
                'message' => 'حدث خطأ أثناء التسجيل: ' . $e->getMessage(),
            ], 500);
        }
    }





    public function submit_provider(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'f_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'user_id' => 'required|digits_between:9,10|unique:users,phone',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {
            // تنسيق رقم الهاتف بإضافة +966
            $phone_number = "+966" . ltrim($request['user_id'], '0'); // إزالة الصفر الأول إن وجد

            // إنشاء المستخدم
            $user = User::create([
                'name' => $request['f_name'],
                'email' => $request['email'],
                'phone' => $phone_number,
                'is_active' => 1,
                'password' => Hash::make($request->password),
                'zone_id' => "3",
                'user_type' => 'provider',
                'membership_type' => "3434",
            ]);

            $user->provider()->create([
                'job' => 'job',
                'address' => 'address',
                'service_type_id' =>$request->service_type,
                'image' => 'def.png',
                'identity_number' =>'identity_number',
                'identity_type' => 'identity_type',
                'latitude' => 'latitude',
                'longitude' => 'longitude',
                'commercial_registration_no' =>'commercial_registration_no'
            ]);
            DB::commit();
            toastr()->success('بنجاح', 'تم السجيل بنجاح');





            return redirect(route('role.showLogin'));

        } catch (\Exception $e) {

            return $e->getMessage();
        
            return response()->json([
                'status' => 0,
                'message' => 'حدث خطأ أثناء التسجيل: ' . $e->getMessage(),
            ], 500);
        }
    }



    


    public function verify(Request $request)
{
    $request->validate(['otp' => 'required']);

    $user_id = $request->input('user_id');

    if (!$user_id) {
    
        return redirect()->route('customer.auth.login');
    }

    $otp = $request->input('otp');

    $user = User::find($user_id);
    $verification = PhoneOrEmailVerification::where('phone_or_email', $user->phone)
        ->where('token', $otp)
        ->first();

    if ($verification) {
        $user->update(['is_active' => 1]);
        $verification->delete();
        Auth::login($user);
     // تسجيل دخول مع تذكر الجلسة
        auth()->guard('customer')->login($user, true); // لاحظ وضعنا true للتذكر
        auth()->guard('customer')->loginUsingId($user_id);


        return redirect()->route('zones-main')->with('success', 'تم التحقق بنجاح!');
    } else {
        return back()->with('error', 'رمز التحقق غير صحيح.');
    }
}



public function showVerificationForm($user_id)
{



    return view('web-views.customer-views.auth.verify', compact('user_id'));
}
public function resendOtp($user_id)
{
    $user = User::find($user_id);

    if ($user) {
        $new_token_generate = rand(100000, 999999);

        PhoneOrEmailVerification::updateOrCreate(
            ['phone_or_email' => $user->phone],
            ['token' => $new_token_generate, 'created_at' => now()]
        );

        // إرسال الرمز الجديد
        $msg = 'رمز التحقق الجديد الخاص بك هو: ' . $new_token_generate;

        $fields = json_encode([
            "userName" => "Abaad",
            "numbers" => $user->phone,
            "userSender" => "ABAAD",
            "apiKey" => "d98696cc4de689215daa663a3b5efe62",
            "msg" => $msg
        ]);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://www.msegat.com/gw/sendsms.php");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
        curl_exec($ch);
        curl_close($ch);

        return back()->with('success', 'تم إرسال رمز التحقق الجديد.');
    }

    return back()->with('error', 'المستخدم غير موجود.');
}



    public function getCustomerVerificationCheck($id)
    {
        $user = User::find($id);
        $response = '';

        $token = rand(1000, 9999);
        DB::table('phone_or_email_verifications')->insert([
            'phone_or_email' => $user['email'],
            'token' => $token,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $phoneVerification = getWebConfig(name: 'phone_verification');
        $emailVerification = getWebConfig(name: 'email_verification');



    }









    // Customer Ajax Verify
    public static function ajax_verify(Request $request)
    {
        Validator::make($request->all(), [
            'token' => 'required',
        ]);

        $email_status = Helpers::get_business_settings('email_verification');
        $phone_status = Helpers::get_business_settings('phone_verification');

        $user = User::find($request->id);
        $verify = PhoneOrEmailVerification::where(['phone_or_email' => $user['email'], 'token' => $request['token']])->first();

        $max_otp_hit = Helpers::get_business_settings('maximum_otp_hit') ?? 5;
        $temp_block_time = Helpers::get_business_settings('temporary_block_time') ?? 5; //minute

        if (isset($verify)) {
            if(isset($verify->temp_block_time ) && Carbon::parse($verify->temp_block_time)->diffInSeconds() <= $temp_block_time){
                $time = $temp_block_time - Carbon::parse($verify->temp_block_time)->diffInSeconds();

                $verify_status = 'error';
                $message = translate('please_try_again_after_').CarbonInterval::seconds($time)->cascade()->forHumans();
                return response()->json([
                    'status'=>$verify_status,
                    'message'=>$message,
                ]);
            }

            ($email_status == 1 || ($phone_status == '0' && $email_status == '0')) ? ($user->is_email_verified = 1) : ($user->is_phone_verified = 1);
            $user->save();
            $verify->delete();

            $verify_status = 'success';
            $message = translate('verification_done_successfully');

        }else{
            $verification = PhoneOrEmailVerification::where(['phone_or_email' => $user['email']])->first();

            if($verification){
                if(isset($verification->temp_block_time) && Carbon::parse($verification->temp_block_time)->diffInSeconds() <= $temp_block_time){
                    $time= $temp_block_time - Carbon::parse($verification->temp_block_time)->diffInSeconds();

                    $verify_status = 'error';
                    $message = translate('please_try_again_after_').CarbonInterval::seconds($time)->cascade()->forHumans();

                }elseif($verification->is_temp_blocked == 1 && isset($verification->created_at) && Carbon::parse($verification->created_at)->diffInSeconds() >= $temp_block_time){
                    $verification->otp_hit_count = 1;
                    $verification->is_temp_blocked = 0;
                    $verification->temp_block_time = null;
                    $verification->updated_at = now();
                    $verification->save();

                    $verify_status = 'error';
                    $message = translate('Verification code/ OTP mismatched');

                }elseif($verification->otp_hit_count >= $max_otp_hit && $verification->is_temp_blocked == 0){
                    $verification->is_temp_blocked = 1;
                    $verification->temp_block_time = now();
                    $verification->updated_at = now();
                    $verification->save();

                    $time= $temp_block_time - Carbon::parse($verification->temp_block_time)->diffInSeconds();
                    $verify_status = 'error';
                    $message = translate('too_many_attempts. please_try_again_after_').CarbonInterval::seconds($time)->cascade()->forHumans();

                }else{
                    $verification->otp_hit_count += 1;
                    $verification->save();

                    $verify_status = 'error';
                    $message = translate('Verification code/ OTP mismatched');
                }
            }else{
                $verify_status = 'error';
                $message = translate('Verification code/ OTP mismatched');
            }
        }

        return response()->json([
            'status'=>$verify_status,
            'message'=>$message,
        ]);
    }


    // Resend OTP Code Using Ajax
    public static function resend_otp(Request $request)
    {
        $user = User::find($request->user_id);
        $token = PhoneOrEmailVerification::where('phone_or_email','=', $user['email'])->first();
        $otp_resend_time = Helpers::get_business_settings('otp_resend_time') > 0 ? Helpers::get_business_settings('otp_resend_time') : 0;

        // Time Difference in Minutes
        if($token){
            $token_time = Carbon::parse($token->created_at);
            $add_time = $token_time->addSeconds($otp_resend_time);
            $time_differance = $add_time > Carbon::now() ? Carbon::now()->diffInSeconds($add_time) : 0;
        }else{
            $time_differance = 0;
        }

        $new_token_generate = rand(1000, 9999);
        if($time_differance==0){
            if($token){
                $token->token = $new_token_generate;
                $token->otp_hit_count = 0;
                $token->is_temp_blocked = 0;
                $token->temp_block_time = null;
                $token->created_at = now();
                $token->save();
            }else{
                $new_token = new PhoneOrEmailVerification();
                $new_token->phone_or_email = $user['email'];
                $new_token->token = $new_token_generate;
                $new_token->created_at = now();
                $new_token->updated_at = now();
                $new_token->save();
            }

            $phone_verification = Helpers::get_business_settings('phone_verification');
            $email_verification = Helpers::get_business_settings('email_verification');
            if ($phone_verification && !$user->is_phone_verified) {

                $published_status = 0;
                $payment_published_status = config('get_payment_publish_status');
                if (isset($payment_published_status[0]['is_published'])) {
                    $published_status = $payment_published_status[0]['is_published'];
                }

                if($published_status == 1){
                    // SmsGateway::send($user->phone, $new_token_generate);

                    $ch = curl_init();
                    $msg = 'مرحبا' . ' ' . $request->f_name . ' ' . 'كود تفعيل  الرقم الخاص بك ' . ' ' . $new_token_generate;
                    curl_setopt($ch, CURLOPT_URL, "https://www.msegat.com/gw/sendsms.php");
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                    curl_setopt($ch, CURLOPT_HEADER, TRUE);

                    curl_setopt($ch, CURLOPT_POST, TRUE);

                    $fields = <<<EOT
            {
              "userName": "Abaad",
              "numbers": "$user->pone",
              "userSender": "ABAAD",
              "apiKey": "d98696cc4de689215daa663a3b5efe62",
              "msg": "$msg"
            }
            EOT;
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

                    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                        "Content-Type: application/json"
                    ));
            //
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            //            end sms code verification

                    $server_output = curl_exec($ch);

                    curl_close($ch);
                }else{




                    $ch = curl_init();
                    $msg = 'مرحبا' . ' ' . $request->f_name . ' ' . 'كود تفعيل  الرقم الخاص بك ' . ' ' . $new_token_generate;
                    curl_setopt($ch, CURLOPT_URL, "https://www.msegat.com/gw/sendsms.php");
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                    curl_setopt($ch, CURLOPT_HEADER, TRUE);

                    curl_setopt($ch, CURLOPT_POST, TRUE);

                    $fields = <<<EOT
            {
              "userName": "Abaad",
              "numbers": "$user->phone",
              "userSender": "ABAAD",
              "apiKey": "d98696cc4de689215daa663a3b5efe62",
              "msg": "$msg"
            }
            EOT;
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

                    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                        "Content-Type: application/json"
                    ));
            //
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            //            end sms code verification

                    $server_output = curl_exec($ch);

                    curl_close($ch);
                }
            }

            if ($email_verification && !$user->is_email_verified) {
                $email_services_smtp = Helpers::get_business_settings('mail_config');
                if ($email_services_smtp['status'] == 0) {
                    $email_services_smtp = Helpers::get_business_settings('mail_config_sendgrid');
                }
                if ($email_services_smtp['status'] == 1) {
                    try{
                        $data = [
                            'userName' => $user['f_name'],
                            'subject' => translate('registration_Verification_Code'),
                            'title' => translate('registration_Verification_Code'),
                            'verificationCode' => $new_token_generate,
                            'userType'=>'customer',
                            'templateName'=> 'registration-verification',
                        ];
                        event(new EmailVerificationEvent(email: $user['email'],data: $data));
                    } catch (\Exception $exception) {
                        return response()->json([
                            'status'=>"0",
                        ]);
                    }
                }
            }
            return response()->json([
                'status'=>"1",
                'new_time'=> $otp_resend_time,
            ]);
        } else {
            return response()->json([
                'status'=>"0",
            ]);
        }
    }

}
