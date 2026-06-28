<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * نقطة استرجاع ذاتية لمزود الخدمة: يعرف ما الأدوار/الصلاحيات الممنوحة له،
 * مفيدة لتطبيق الموبايل لإظهار/إخفاء عناصر الواجهة بناءً على الصلاحية الفعلية
 * بدل الاعتماد فقط على افتراض "كل مزود = كل الصلاحيات".
 */
class ProviderPermissionController extends Controller
{
    private const AUTH_GUARD = 'api';

    public function index(Request $request): JsonResponse
    {
        $user = $request->user(self::AUTH_GUARD);

        return response()->json([
            'status' => 'success',
            'data' => [
                'roles'       => $user->getRoleNames()->values(),
                'permissions' => $user->getAllPermissions()->pluck('name')->values(),
            ],
        ], 200);
    }
}