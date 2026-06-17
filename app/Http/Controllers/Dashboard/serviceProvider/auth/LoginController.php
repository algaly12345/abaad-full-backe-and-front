<?php

namespace App\Http\Controllers\Dashboard\serviceProvider\auth;

use App\Http\Controllers\Controller;
use Brian2694\Toastr\Toastr;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function loginForm()
    {
        return view('dashboard.auth.service-provider-login');
    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required'
        ]);



        return $request;

        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            return to_route('service-provider.offers.map');
        } else {
            Toastr::error(translate('credentials_doesnt_match'));
        }
    }
}
