<?php


namespace App\Http\Controllers\Dashboard\Auth;

use App\Http\Controllers\Controller; // مهم

use App\Helpers\Helpers as HelpersHelpers;
use App\Utils\Helpers;
use App\Models\Admin;
use App\Models\BusinessSetting;
use Brian2694\Toastr\Facades\Toastr;
use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;



class LoginController extends Controller
{
    public function loginForm()
    {
        return view('dashboard.auth.role-login');
    }


    public function login(Request $request)
    {
        // التحقق من صحة البيانات المدخلة
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',  // تمت إزالة unique:users
            'password' => 'required',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // بيانات الاعتماد
        $credentials = $request->only('email', 'password');
    
        // محاولة تسجيل الدخول
        if (auth()->guard('user')->attempt($credentials)) {
            // جلب المستخدم بعد نجاح تسجيل الدخول
            $user = auth()->guard('user')->user();
            
            // إعادة توجيه بناءً على نوع المستخدم
            return $this->redirectToSpecificDestination($user->user_type);
        } else {
            Toastr::error("البريد الإلكتروني أو كلمة المرور غير صحيحة");
            return back()->withInput();
        }
    }
    

    // public function redirectToSpecificDestination($user_type)
    // {
    //     if ($user_type == 'provider') {
    //         return to_route('service-provider.offers.pending');
    //     } else {
    //         return to_route('estates.index');
    //     }
    // }


    
    public function redirectToSpecificDestination($user_type)
    {
        if ($user_type == 'provider') {
            return to_route('service-provider.dashboard');
        } else {
            return to_route('estates.index');
        }
    }
}