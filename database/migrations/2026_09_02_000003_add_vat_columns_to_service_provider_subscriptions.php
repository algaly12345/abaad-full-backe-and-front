<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * لقطة ضريبة القيمة المضافة وقت إنشاء الاشتراك: النسبة المطبَّقة وقيمتها
     * بالريال. price نفسه يبقى شاملاً الضريبة (هو المبلغ المُرسَل فعليًا إلى
     * Moyasar)، وهذان العمودان لأغراض الفوترة والتقارير والمطابقة المالية.
     */
    public function up(): void
    {
        Schema::table('service_provider_subscriptions', function (Blueprint $table) {
            if (! Schema::hasColumn('service_provider_subscriptions', 'vat_percent')) {
                $table->decimal('vat_percent', 5, 2)->nullable()->after('price');
            }
            if (! Schema::hasColumn('service_provider_subscriptions', 'vat_amount')) {
                $table->decimal('vat_amount', 12, 2)->nullable()->after('vat_percent');
            }
        });
    }

    public function down(): void
    {
        Schema::table('service_provider_subscriptions', function (Blueprint $table) {
            foreach (['vat_amount', 'vat_percent'] as $column) {
                if (Schema::hasColumn('service_provider_subscriptions', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
