<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * قرار العمل النهائي: مدة انتظار العمولة (قبل الاعتماد التلقائي) هي 14 يومًا
 * بدل 10 (فترة استرجاع الاشتراك). لا يوجد حتى الآن أي شاشة إدارة تسمح بتعديل
 * referral_settings يدويًا، لذا التحديث المباشر هنا آمن ولا يطمس أي قيمة
 * خصّصها مستخدم.
 */
return new class extends Migration
{
    public function up()
    {
        DB::table('referral_settings')->update([
            'commission_hold_days' => 14,
            'updated_at' => now(),
        ]);
    }

    public function down()
    {
        DB::table('referral_settings')->update([
            'commission_hold_days' => 10,
            'updated_at' => now(),
        ]);
    }
};
