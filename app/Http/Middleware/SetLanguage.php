<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLanguage
{
    public function handle(Request $request, Closure $next)
    {
     $locale = Session::get('locale', 'ar');
        App::setLocale($locale);

        // تحديد اتجاه الموقع بناءً على اللغة
        $direction = ($locale == 'ar') ? 'rtl' : 'ltr';
        Session::put('direction', $direction);

        return $next($request);
    }
}
