<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * معرّف دفعة Moyasar الذي فعّل هذا الاشتراك — يُكتب من أي مصدر تأكيد
     * (callback المتصفح، أو webhook، أو أمر المطابقة payments:reconcile-moyasar)
     * ويُستخدم للتتبّع ولجعل التفعيل idempotent.
     */
    public function up(): void
    {
        Schema::table('service_provider_subscriptions', function (Blueprint $table) {
            if (! Schema::hasColumn('service_provider_subscriptions', 'moyasar_payment_id')) {
                $table->string('moyasar_payment_id')->nullable()->index();
            }
        });
    }

    public function down(): void
    {
        Schema::table('service_provider_subscriptions', function (Blueprint $table) {
            if (Schema::hasColumn('service_provider_subscriptions', 'moyasar_payment_id')) {
                $table->dropColumn('moyasar_payment_id');
            }
        });
    }
};
