<?php

namespace App\Http\Controllers\api\v1\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Passport\Client as PassportClient;

class AdminAuthController extends Controller
{
    /**
     * تسجيل دخول الأدمن وإصدار access_token عبر Passport
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
            ], 422);
        }

        $admin = Admin::where('email', $request->email)->first();

        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return response()->json([
                'success' => false,
                'message' => 'بيانات الدخول غير صحيحة',
            ], 401);
        }

        if ($admin->status !== 'active') {
            return response()->json([
                'success' => false,
                'message' => 'هذا الحساب معطل، يرجى التواصل مع الإدارة',
            ], 403);
        }

        // إصدار التوكن عبر Passport — نفس آلية auth:api للعملاء
        // لكن باستخدام Admin model بدل Customer model
        $tokenResult = $admin->createToken('AdminAccessToken');
        $token = $tokenResult->accessToken;

        return response()->json([
            'success' => true,
            'message' => 'تم تسجيل الدخول بنجاح',
            'data' => [
                'access_token' => $token,
                'token_type'   => 'Bearer',
                'expires_at'   => $tokenResult->token->expires_at,
                'admin' => [
                    'id'    => $admin->id,
                    'name'  => $admin->name,
                    'email' => $admin->email,
                    'roles' => $admin->getRoleNames(), // من spatie/laravel-permission
                ],
            ],
        ]);
    }

    /**
     * بيانات الأدمن المسجل دخوله حالياً
     */
    public function me(Request $request)
    {
        $admin = $request->user('admin-api');

        return response()->json([
            'success' => true,
            'data' => [
                'id'          => $admin->id,
                'name'        => $admin->name,
                'email'       => $admin->email,
                'roles'       => $admin->getRoleNames(),
                'permissions' => $admin->getAllPermissions()->pluck('name'),
            ],
        ]);
    }

    /**
     * تسجيل الخروج — إلغاء التوكن الحالي فقط
     */
    public function logout(Request $request)
    {
        $request->user('admin-api')->token()->revoke();

        return response()->json([
            'success' => true,
            'message' => 'تم تسجيل الخروج بنجاح',
        ]);
    }

    /**
     * تجديد التوكن (اختياري — حسب إعداد Passport عندك)
     */
    public function refresh(Request $request)
    {
        // يعتمد على إعداد refresh tokens في Passport
        // إن لم يكن مفعّلاً، يحذف هذا الـ endpoint من routes
        return response()->json([
            'success' => false,
            'message' => 'يرجى تفعيل refresh tokens في Passport أولاً',
        ], 501);
    }
}
