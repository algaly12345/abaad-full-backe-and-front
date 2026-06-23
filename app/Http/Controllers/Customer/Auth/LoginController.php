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
    }

    public function submit(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'password' => 'required'
        ]);

        // تهيئة رقم الهاتف بالصيغة الدولية المعتمدة بالنظام
        $user_id = '+966' . ltrim($request->user_id, '0');
        $otp_resend_time = Helpers::get_business_settings('otp_resend_time') > 0 ? Helpers::get_business_settings('otp_resend_time') : 0;

        $user = User::where(['phone' => $user_id])
                    ->orWhere(['email' => $user_id])
                    ->first();

        if (!$user) {
            Toastr::info('الرجاء إنشاء حساب جديد قبل تسجيل الدخول.');
            return redirect()->route('customer.auth.sign-up')->with('تنبية', 'الرجاء إنشاء حساب جديد قبل تسجيل الدخول.');
        }

        $remember = ($request['remember']) ? true : false;

        // التحقق من صحة كلمة المرور باستخدام guard الخاص بالـ customer
        if (!auth()->guard('customer')->attempt(['phone' => $user->phone, 'password' => $request->password], $remember)) {
            Toastr::error('بيانات الدخول أو كلمة المرور غير صحيحة.');
            return back()->withInput();
        }

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

        // في حال لم يكن الهاتف موثقاً من قبل، نرسل كود التفعيل
        if (!$user->is_phone_verified) {
            $new_token_generate = rand(1000, 9999);

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

            return redirect(route('customer.auth.verify-register', [$user->id]));
        }

        Toastr::success(translate('welcome_back'));
        return redirect()->route('zones-main');
    }

    public function logout(Request $request)
    {
        $user = auth()->guard('customer')->user();

        if ($user) {
            DB::table('users')
                ->where('id', $user->id)
                ->update(['is_phone_verified' => 0]);

            auth()->guard('customer')->logout();
            session()->forget('wish_list');
            Toastr::success(translate('come_back_soon').'!');
            return redirect()->route('home');
        }

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