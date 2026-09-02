<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * نسبة ضريبة القيمة المضافة المطبَّقة على إجمالي اشتراك مزوّد الخدمة في
     * مسار "إضافة خدمة" — تُضاف فوق الإجمالي بعد الخصم (راجع
     * ServiceProviderService::calculatePrice). قابلة للتعديل من الإعدادات
     * (SubscriptionSettingManagementController) بدل كونها ثابتة بالكود.
     */
    public function up(): void
    {
        Schema::table('subscription_pricing_settings', function (Blueprint $table) {
            if (! Schema::hasColumn('subscription_pricing_settings', 'vat_percent')) {
                $table->decimal('vat_percent', 5, 2)->default(15)->after('extra_category_price');
            }
        });
    }

    public function down(): void
    {
        Schema::table('subscription_pricing_settings', function (Blueprint $table) {
            if (Schema::hasColumn('subscription_pricing_settings', 'vat_percent')) {
                $table->dropColumn('vat_percent');
            }
        });
    }
};
