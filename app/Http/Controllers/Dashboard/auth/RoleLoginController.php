<?php

namespace App\Http\Controllers\Dashboard\auth;

use App\Http\Controllers\Controller;
use App\Models\PhoneOrEmailVerification;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class RoleLoginController extends Controller
{
    public function loginForm()
    {
        return view('dashboard.auth.role-login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => ['required', 'regex:/^5\d{8}$/'],
        ], [
            'phone.required' => 'رقم الجوال مطلوب',
            'phone.regex' => 'يجب إدخال رقم جوال سعودي يبدأ بـ 5 ويتكون من 9 أرقام',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $phone = $this->normalizeSaudiPhone($request->phone);

        if (!$phone) {
            Toastr::error('رقم الجوال غير صحيح');
            return back()->withInput();
        }

        $user = User::where('phone', $phone)
            ->where('user_type', 'provider')
            ->first();

        if (!$user) {
            Toastr::error('رقم الجوال غير مسجل كمزود خدمة');
            return back()->withInput();
        }

        $new_token_generate = random_int(100000, 999999);

        $token = PhoneOrEmailVerification::where('phone_or_email', $phone)->first();

        if ($token) {
            $token->update([
                'token' => $new_token_generate,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } else {
            PhoneOrEmailVerification::create([
                'phone_or_email' => $phone,
                'token' => $new_token_generate,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $msg = 'مرحبا ' . ($user->name ?? '') . '، كود تسجيل الدخول هو: ' . $new_token_generate;

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post('https://www.msegat.com/gw/sendsms.php', [
                'userName'   =>"Abaad",
                'numbers'    => str_replace('+', '', $phone),
                'userSender' => "ABAAD",
                'apiKey'     =>"d98696cc4de689215daa663a3b5efe62",
                'msg'        => $msg,
            ]);

            if (!$response->successful()) {
                Toastr::error('تعذر إرسال رمز التحقق');
                return back()->withInput();
            }
        } catch (\Exception $e) {
            Toastr::error('حدث خطأ أثناء إرسال رمز التحقق');
            return back()->withInput();
        }

        session([
            'otp_phone' => $phone,
        ]);

        Toastr::success('تم إرسال رمز التحقق إلى رقم الجوال');
        return redirect()->route('role.otp.form');
    }

    public function otpForm()
    {
        if (!session()->has('otp_phone')) {
            Toastr::error('ابدأ بإدخال رقم الجوال أولاً');
            return redirect()->route('role.showLogin');
        }

        return view('dashboard.auth.role-otp');
    }

    public function verifyOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'otp' => ['required', 'digits:6'],
        ], [
            'otp.required' => 'رمز التحقق مطلوب',
            'otp.digits' => 'رمز التحقق يجب أن يكون 6 أرقام',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $phone = session('otp_phone');

        if (!$phone) {
            Toastr::error('انتهت جلسة التحقق');
            return redirect()->route('role.showLogin');
        }

        $verification = PhoneOrEmailVerification::where('phone_or_email', $phone)
            ->where('token', $request->otp)
            ->first();

        if (!$verification) {
            Toastr::error('رمز التحقق غير صحيح');
            return back()->withInput();
        }

        if (Carbon::parse($verification->updated_at)->addMinutes(5)->isPast()) {
            Toastr::error('انتهت صلاحية رمز التحقق');
            return redirect()->route('role.showLogin');
        }

        $user = User::where('phone', $phone)
            ->where('user_type', 'provider')
            ->first();

        if (!$user) {
            Toastr::error('المستخدم غير موجود أو ليس مزود خدمة');
            return redirect()->route('role.showLogin');
        }

        Auth::guard('user')->login($user);

        $loggedInUser = Auth::guard('user')->user();

        if (!$loggedInUser) {
            Toastr::error('فشل تسجيل الدخول');
            return redirect()->route('role.showLogin');
        }

        $verification->delete();
        session()->forget('otp_phone');

        return $this->redirectToSpecificDestination($loggedInUser);
    }

    public function resendOtp()
    {
        $phone = session('otp_phone');

        if (!$phone) {
            Toastr::error('انتهت الجلسة، أعد المحاولة');
            return redirect()->route('role.showLogin');
        }

        $user = User::where('phone', $phone)
            ->where('user_type', 'provider')
            ->first();

        if (!$user) {
            Toastr::error('المستخدم غير موجود');
            return redirect()->route('role.showLogin');
        }

        $new_token_generate = random_int(100000, 999999);

        $token = PhoneOrEmailVerification::where('phone_or_email', $phone)->first();

        if ($token) {
            $token->update([
                'token' => $new_token_generate,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } else {
            PhoneOrEmailVerification::create([
                'phone_or_email' => $phone,
                'token' => $new_token_generate,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $msg = 'مرحبا ' . ($user->name ?? '') . '، كود تسجيل الدخول هو: ' . $new_token_generate;

        try {
            Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post('https://www.msegat.com/gw/sendsms.php', [
                'userName'   => env('MSEGAT_USERNAME', 'Abaad'),
                'numbers'    => str_replace('+', '', $phone),
                'userSender' => env('MSEGAT_SENDER', 'ABAAD'),
                'apiKey'     => env('MSEGAT_API_KEY'),
                'msg'        => $msg,
            ]);
        } catch (\Exception $e) {
            Toastr::error('تعذر إعادة إرسال رمز التحقق');
            return back();
        }

        Toastr::success('تم إعادة إرسال رمز التحقق');
        return back();
    }

    private function normalizeSaudiPhone($phone)
    {
        $phone = preg_replace('/\D/', '', $phone);

        if (preg_match('/^5\d{8}$/', $phone)) {
            return '+966' . $phone;
        }

        return null;
    }

    public function redirectToSpecificDestination($user)
    {
        if (!$user) {
            Toastr::error('المستخدم غير موجود');
            return to_route('role.showLogin');
        }

        if ($user->user_type === 'provider') {
            return to_route('service-provider.dashboard');
        }

        Toastr::error('هذا الحساب غير مصرح له بدخول لوحة مزود الخدمة');
        Auth::guard('user')->logout();
        return to_route('role.showLogin');
    }
}