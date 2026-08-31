<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Exceptions\InvalidSignatureException;
use Illuminate\Support\Str;

class ValidateMoyasarCallbackSignature
{
    /**
     * بعد تدفّق 3-D Secure (بطاقات مدى تُحوِّل المتصفح دائمًا) يُعيد Moyasar
     * المتصفحَ إلى callback_url وهو يُلحق بكامل كائن الدفع كـ query params
     * (id, status, amount, message, source[...], metadata[...] ...). فحص
     * Laravel القياسي لرابط signed يُوقِّع سلسلة الاستعلام كاملةً، فتُصبح
     * التوقيعة غير مطابقة ويظهر 403 "Invalid signature" — وهو ما كان يفشل
     * عليه الدفع بمدى دائمًا.
     *
     * الرابط الأصلي وُقِّع بـ URL::temporarySignedRoute ولا يحمل من الاستعلام
     * سوى expires (+ signature)، لذا نتجاهل كل مُعامل ألحقه Moyasar ونتحقق
     * من expires + signature فقط. لا يُضعِف هذا الأمان: التوقيعة تظل تضمن
     * مسارَ الاشتراك وتاريخ الانتهاء، و MoyasarPaymentController::callback
     * يتحقق لاحقًا server-to-server من حالة الدفع والمبلغ ورقم الاشتراك قبل
     * أي تفعيل.
     */
    public function handle(Request $request, Closure $next)
    {
        // نطابق على أسماء مقاطع QUERY_STRING الخام لأن المعاملات المتداخلة
        // تُرسَل بصيغة source%5Btype%5D ولن تُطابق مفتاحًا مُفكَّكًا اسمه source.
        $ignore = collect(explode('&', (string) $request->server->get('QUERY_STRING')))
            ->map(fn ($pair) => Str::before($pair, '='))
            ->reject(fn ($key) => $key === '' || $key === 'expires' || $key === 'signature')
            ->values()
            ->all();

        if ($request->hasValidSignatureWhileIgnoring($ignore)) {
            return $next($request);
        }

        throw new InvalidSignatureException;
    }
}
