<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * حالة اعتماد طلب مزوّد الخدمة — تُضبَط 'pending' آليًا عند نجاح أول دفعة
 * اشتراك (MoyasarPaymentController::callback)، ثم يُحوّلها الأدمن يدويًا
 * إلى 'approved' (فيتحول user_type إلى provider) أو 'rejected' عبر
 * admin/providers/{user}/approve|reject. راجع App\Enums\ProviderApprovalStatus.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('service_providers', function (Blueprint $table) {
            $table->string('approval_status')->nullable()->after('commercial_registration_no');
        });
    }

    public function down(): void
    {
        Schema::table('service_providers', function (Blueprint $table) {
            $table->dropColumn('approval_status');
        });
    }
};
