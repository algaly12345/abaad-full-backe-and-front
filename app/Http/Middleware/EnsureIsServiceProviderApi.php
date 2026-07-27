<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class EnsureIsServiceProviderApi
{
    private const AUTH_GUARD = 'api';

    public function handle(Request $request, Closure $next)
    {
        $user = $request->user(self::AUTH_GUARD);

        if (!$user) {
            return response()->json([
                'status'  => 'error',
                'message' => 'يجب تسجيل الدخول',
            ], 401);
        }

        if ($user->user_type !== User::TYPE_PROVIDER) {
            return response()->json([
                'status'  => 'error',
                'message' => 'عفواً، هذه الميزة متاحة فقط لمزودي الخدمات المعتمدين.',
                'errors'  => [
                    ['code' => 'auth-003', 'message' => 'Access Denied: Not a Service Provider'],
                ],
            ], 403);
        }

        return $next($request);
    }
}