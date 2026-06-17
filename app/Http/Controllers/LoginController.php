<?php

namespace App\Http\Controllers;

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
    public function __construct()
    {
        $this->middleware('guest:admin', ['except' => 'logout']);
    }

    public function login($login_url)
    {
        $data = array_column(BusinessSetting::whereIn('type',['employee_login_url','admin_login_url'])->get(['type','value'])->toArray(), 'value', 'type');

        $loginTypes = [
            'admin' => 'admin_login_url',
            'employee' => 'employee_login_url'
        ];

        $role = null;

        $user_type = array_search($login_url,$data);
        abort_if(!$user_type, 404 );
        $role = array_search($user_type,$loginTypes,true);
        abort_if($role == null ,404);

        $custome_recaptcha = new CaptchaBuilder;
        $custome_recaptcha->build();
        Session::put('six_captcha', $custome_recaptcha->getPhrase());

        if ($role == 'admin') {
            return view('admin-views.auth.login', compact('custome_recaptcha','role'));
        }else if ($role == 'employee') {
            return view('admin-views.auth.login', compact('custome_recaptcha','role'));
        }

    }

    public function submit(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
            'role' => 'required'
        ]);



        if ($request->role == 'admin') {
            $data = Admin::where('email', $request->email)->where('admin_role_id', 1)->first();

            if (!isset($data)) {
                return redirect()->back()->withInput($request->only('email', 'remember'))
                            ->withErrors(['Credentials does not match.']);
            }else if (isset($data) && $data->status != 1) {
                return redirect()->back()->withInput($request->only('email', 'remember'))
                    ->withErrors(['You are blocked!!, contact with admin.']);
            }
        } elseif ($request->role == 'employee') {

            $data = Admin::where('email', $request->email)->where('admin_role_id','!=' ,1)->first();

            if (!isset($data)) {
                return redirect()->back()->withInput($request->only('email', 'remember'))
                            ->withErrors(['Credentials does not match.']);
            }else if (isset($data) && $data->status != 1) {
                return redirect()->back()->withInput($request->only('email', 'remember'))
                    ->withErrors(['You are blocked!!, contact with admin.']);
            }

        } else {
            Toastr::error(translate('role_missing'));
            return back();
        }

        $data = $this->login_attemp($request->role, $request->email, $request->password, $request->remember);

        if ($data == 'admin' || $data == 'employee') {
            return redirect()->route('admin.dashboard.index');
        }

        return redirect()->back()->withInput($request->only('email', 'remember'))
            ->withErrors(['Credentials does not match.']);
    }

    public function login_attemp($role,$email ,$password, $remember = false)
    {
        if ($role == 'admin' || $role == 'employee') {
            if (auth('admin')->attempt(['email' => $email, 'password' => $password], $remember)) {
                return $role;
            }
        }
        return false;
    }




}
