<?php

namespace App\Http\Controllers\Customer\Auth;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\PhoneOrEmailVerification;
use App\Models\ProductCompare;
use App\Models\Wishlist;
use App\Models\User;
use App\Utils\CartManager;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public $company_name;

    public function __construct()
    {
        $this->middleware('guest:customer', ['except' => ['logout']]);
    }



    public function login()
    {
        session()->put('keep_return_url', url()->previous());


            return view('web-views.customer-views.auth.login');
        // }else{
        //     return redirect()->route('home');
        // }
    }

    public function submit(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'password' => 'required'
        ]);

        // Recaptcha validation start
        // Recaptcha validation end

        // Add country code +966 to the user_id
        $user_id = '+966' . $request->user_id;
        $token = PhoneOrEmailVerification::where('phone_or_email','=', $user_id)->first();
        $otp_resend_time = Helpers::get_business_settings('otp_resend_time') > 0 ? Helpers::get_business_settings('otp_resend_time') : 0;


        // Try to find the user by phone or email
        $user = User::where(['phone' => $user_id])
                    ->orWhere(['email' => $user_id])
                    ->first();

        if (!$user) {
            Toastr::info('الرجاء إنشاء حساب جديد قبل تسجيل الدخول.');

            return redirect()->route('customer.auth.sign-up')->with('تنبية', 'الرجاء إنشاء حساب جديد قبل تسجيل الدخول.');


        }

        $remember = ($request['remember']) ? true : false;

        $agent = Agent::where('user_id', $user->id)->first();

        if (!$agent) {
            Agent::create([
                'user_id' => $user->id,
                'name' =>'Default User',
                'phone' =>  $user_id,
                'agent_type' => 'فرد',
                'membership_type' => 'customer',
            ]);
        }



        // Login attempt check start
        $max_login_hit = Helpers::get_business_settings('maximum_login_hit') ?? 5;
        $temp_block_time = Helpers::get_business_settings('temporary_login_block_time') ?? 5; // seconds

        if (!$user) {
            if ($request->ajax()) {
                return response()->json([
                    'status' => 'error',
                    'message' => translate('credentials_doesnt_match'),
                    'redirect_url' => ''
                ]);
            } else {
                Toastr::error(translate('credentials_doesnt_match'));
                return back()->withInput();
            }
        }
        // Login attempt check end

        // Phone or email verification check start
        $phone_verification = Helpers::get_business_settings('phone_verification');
        $email_verification = Helpers::get_business_settings('email_verification');

        $new_token_generate = rand(1000, 999);

            // التحقق من وجود رمز مسبق بناءً على رقم الهاتف
            $token = PhoneOrEmailVerification::where('phone_or_email', $user_id)->first();

            if ($token) {
                $token->update([
                    'token' => $new_token_generate,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } else {
                PhoneOrEmailVerification::create([
                    'phone_or_email' => $user_id,
                    'token' => $new_token_generate,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // إرسال رسالة OTP عبر SMS
            $msg = 'مرحبا ' . $request->f_name . '، كود تفعيل رقمك هو: ' . $new_token_generate;

            $fields = json_encode([
                "userName" => "Abaad",
                "numbers" => $user_id,
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




    }


    public function logout(Request $request)
    {
        $user = auth()->guard('customer')->user();

        if ($user) {
            // Update the is_phone_verified field to 0 using raw SQL query
            DB::table('users')
                ->where('id', $user->id)
                ->update(['is_phone_verified' => 0]);

            // Log out the user
            auth()->guard('customer')->logout();

            // Forget the wish_list session
            session()->forget('wish_list');

            // Display a success message
            Toastr::success(translate('come_back_soon').'!');

            // Redirect to the home route
            return redirect()->route('home');
        }

        // If no user is found, redirect to home
        return redirect()->route('home');
    }


    public function get_login_modal_data(Request $request)
    {
        return response()->json([
            'login_modal' => view(VIEW_FILE_NAMES['get_login_modal_data'])->render(),
            'register_modal' => view(VIEW_FILE_NAMES['get_register_modal_data'])->render(),
        ]);
    }





}
