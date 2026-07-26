<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Referral::commission() هي علاقة hasOne (عمولة واحدة فقط لكل إحالة — "أول
 * اشتراك فقط")، لكن referral_id كان مفهرسًا فقط بدون قيد unique. هذا يترك
 * نافذة سباق (race condition): استدعاءان متزامنان لـ
 * ReferralCommissionService::createCommissionForPaidSubscription لنفس
 * الإحالة (مثلاً إعادة محاولة webhook من Moyasar) قد ينشئان عمولتين. القفل
 * (lockForUpdate) في الكود يمنع هذا عمليًا، لكن هذا القيد هو الضمانة الأخيرة
 * على مستوى قاعدة البيانات.
 *
 * ⚠️ قبل تشغيلها على قاعدة بيانات الإنتاج: تأكد أولًا من عدم وجود صفوف
 * commissions مكررة لنفس referral_id (استعلام تحقق موجود في تقرير المراجعة)،
 * وإلا ستفشل هذه الـ migration.
 */
return new class extends Migration
{
    public function up()
    {
        Schema::table('commissions', function (Blueprint $table) {
            $table->unique('referral_id', 'commissions_referral_id_unique');
        });
    }

    public function down()
    {
        Schema::table('commissions', function (Blueprint $table) {
            $table->dropUnique('commissions_referral_id_unique');
        });
    }
};
