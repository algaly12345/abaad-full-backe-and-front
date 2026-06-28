<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class UserPermissionController extends Controller
{
    private const AUTH_GUARD = 'api';

    /**
     * إسناد صلاحية واحدة أو عدة صلاحيات لمستخدم
     */
    public function assign(Request $request, $id): JsonResponse
    {
        $request->validate([
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,name'
        ]);

        $user = User::findOrFail($id);
        
        // إعطاء الصلاحيات للمستخدم
        $user->givePermissionTo($request->permissions);

        return response()->json([
            'status' => 'success',
            'message' => 'تم منح الصلاحيات بنجاح',
            'current_permissions' => $user->getAllPermissions()->pluck('name')
        ], 200);
    }

    /**
     * سحب (إلغاء) صلاحية أو عدة صلاحيات من مستخدم
     */
    public function revoke(Request $request, $id): JsonResponse
    {
        $request->validate([
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,name'
        ]);

        $user = User::findOrFail($id);

        // سحب الصلاحيات
        foreach ($request->permissions as $permission) {
            $user->revokePermissionTo($permission);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'تم سحب الصلاحيات بنجاح',
            'current_permissions' => $user->getAllPermissions()->pluck('name')
        ], 200);
    }

    /**
     * مزامنة الصلاحيات (تستخدم مع الـ Checkboxes في لوحة التحكم)
     * تحذف كل الصلاحيات القديمة وتضع الصلاحيات الجديدة الممررة فقط
     */
    public function sync(Request $request, $id): JsonResponse
    {
        $request->validate([
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,name'
        ]);

        $user = User::findOrFail($id);

        // المزامنة: ما هو موجود في المصفوفة يبقى/يُضاف، وما هو غير موجود يُحذف
        $user->syncPermissions($request->permissions ?? []);

        return response()->json([
            'status' => 'success',
            'message' => 'تمت مزامنة الصلاحيات بنجاح',
            'current_permissions' => $user->getAllPermissions()->pluck('name')
        ], 200);
    }

    /**
     * عرض جميع الصلاحيات المتوفرة في النظام (لتعبئة الـ Checkboxes في الواجهة)
     */
    public function allPermissions(): JsonResponse
    {
        $permissions = Permission::where('guard_name', 'api')->pluck('name');

        return response()->json([
            'status' => 'success',
            'data' => $permissions
        ], 200);
    }
}