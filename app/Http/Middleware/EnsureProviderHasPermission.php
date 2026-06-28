<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * ميدلوير صلاحيات مزود الخدمة.
 *
 * الفرق بينه وبين EnsureIsServiceProviderApi:
 * - EnsureIsServiceProviderApi يثبت فقط: "هل هذا الحساب من نوع provider؟"
 * - هذا الميدلوير يثبت: "هل يملك هذا المزود الصلاحية المحددة (أو إحداها)؟"
 *
 * الاستخدام في المسارات (منطق OR — تكفي صلاحية واحدة من المُمررة):
 *   ->middleware('provider.permission:services.create')
 *   ->middleware('provider.permission:services.update,services.delete')
 *
 * يُستخدم دائمًا بعد ['auth:api', 'provider.api'] في نفس المجموعة.
 */
class EnsureProviderHasPermission
{
    private const AUTH_GUARD = 'api';

    public function handle(Request $request, Closure $next, string ...$permissions)
    {
        $user = $request->user(self::AUTH_GUARD);

        if (!$user) {
            return response()->json([
                'status'  => 'error',
                'message' => 'يجب تسجيل الدخول',
                'errors'  => [
                    ['code' => 'auth-001', 'message' => 'Unauthenticated'],
                ],
            ], 401);
        }

        if (empty($permissions)) {
            return $next($request);
        }

        if (!$user->hasAnyPermission($permissions)) {
            return response()->json([
                'status'  => 'error',
                'message' => 'عفواً، لا تملك الصلاحية الكافية لتنفيذ هذا الإجراء.',
                'errors'  => [
                    [
                        'code'                 => 'auth-004',
                        'message'              => 'Access Denied: Missing required permission',
                        'required_permissions' => $permissions,
                    ],
                ],
            ], 403);
        }

        return $next($request);
    }
}