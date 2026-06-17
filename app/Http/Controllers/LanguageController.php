<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function changeLanguage(Request $request)
    {


        
        $request->validate([
            'language_code' => 'required|string',
        ]);

        $languageCode = $request->input('language_code');

        // Set the session value for language
        Session::put('locale', $languageCode);

        // Change the direction based on the language code
        $direction = ($languageCode == 'ar') ? 'rtl' : 'ltr';
        Session::put('direction', $direction);

        return redirect()->back();
    }




    public function change(Request $request)
    {


        $request->validate([
            'language_code' => 'required|string',
        ]);

        $languageCode = $request->input('language_code');

        // تعيين لغة الجلسة
        Session::put('locale', $languageCode);

        // تغيير الاتجاه بناءً على اللغة
        $direction = ($languageCode == 'ar') ? 'rtl' : 'ltr';
        Session::put('direction', $direction);

        return redirect()->back();

    }
}
