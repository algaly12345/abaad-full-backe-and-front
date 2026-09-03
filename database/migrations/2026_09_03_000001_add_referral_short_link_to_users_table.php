<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * users.referral_short_link: الرابط القصير من ChottuLink (نطاق go.abaadapp.sa)
 * الخاص بكل مزوّد خدمة. يُنشأ مرة واحدة عند أول طلب /api/v1/referrals/my-link
 * (انظر ReferralController::myLink + ChottuLinkService) ويُخزَّن هنا حتى لا
 * يُعاد استدعاء ChottuLink في كل مرة. nullable: لو فشل نداء ChottuLink يبقى
 * فارغًا ويتراجع الرد للرابط الخام https://abaadapp.sa/ref/{code}.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'referral_short_link')) {
                $table->string('referral_short_link')->nullable()->after('referred_by_id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'referral_short_link')) {
                $table->dropColumn('referral_short_link');
            }
        });
    }
};
