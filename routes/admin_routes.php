<?php

use App\Http\Controllers\api\v1\admin\AdminAuthController;
use App\Http\Controllers\api\v1\admin\AdminDashboardController;
use App\Http\Controllers\api\v1\admin\AdminOfferController;
use App\Http\Controllers\api\v1\admin\AdminProviderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin API Routes
|--------------------------------------------------------------------------
|
| كل هذه الـ routes تحت بريفكس api/v1/admin
| المصادقة عبر guard مستقل (admin-api) منفصل عن عملاء التطبيق
|
*/

Route::group(['prefix' => 'admin'], function () {

    // ── تسجيل الدخول — بدون حماية ──────────────────────────────
    Route::group(['prefix' => 'auth'], function () {
        Route::post('login', [AdminAuthController::class, 'login']);
        Route::post('refresh-token', [AdminAuthController::class, 'refresh']);
    });

    // ── قائمة الحالات ثابتة وغير حساسة — متاحة بدون توكن حتى تُبنى
    // القائمة المنسدلة بالفرونت قبل تسجيل الدخول أيضاً ──────────
    Route::get('offers/statuses', [AdminOfferController::class, 'statuses']);
    Route::get('providers/statuses', [AdminProviderController::class, 'statuses']);

    // ── كل ما بعد هذا يتطلب تسجيل دخول صحيح كأدمن ──────────────
    Route::group(['middleware' => 'auth:admin-api'], function () {

        Route::post('auth/logout', [AdminAuthController::class, 'logout']);
        Route::get('auth/me', [AdminAuthController::class, 'me']);

        // ── الإحصائيات الرئيسية للداشبورد ───────────────────────
        Route::group(['prefix' => 'dashboard'], function () {
            Route::get('stats', [AdminDashboardController::class, 'stats']);
            Route::get('recent-activities', [AdminDashboardController::class, 'recentActivities']);
            Route::get('chart-data', [AdminDashboardController::class, 'chartData']);
        });

        // ── تغيير حالة عرض خدمة ─────────────────────────────────
        Route::put('offers/{offer}/status', [AdminOfferController::class, 'updateStatus']);

        // ── مراجعة/اعتماد طلبات "الترقية إلى مزوّد خدمة" ─────────
        Route::get('providers/pending', [AdminProviderController::class, 'pending']);
        Route::post('providers/{user}/approve', [AdminProviderController::class, 'approve']);
        Route::post('providers/{user}/reject', [AdminProviderController::class, 'reject']);

    });

});
