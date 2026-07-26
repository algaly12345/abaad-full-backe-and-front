<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * users.referral_code / users.referred_by_id موجودان بالفعل في قاعدة
 * البيانات الحالية (بدون migration مطابقة). idempotent لضمان وجودهما في أي
 * بيئة جديدة.
 */
return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'referral_code')) {
                $table->string('referral_code', 20)->nullable()->unique()->after('ref_code');
            }
            if (!Schema::hasColumn('users', 'referred_by_id')) {
                $table->unsignedBigInteger('referred_by_id')->nullable()->index()->after('referral_code');
            }
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'referred_by_id')) {
                $table->dropColumn('referred_by_id');
            }
            if (Schema::hasColumn('users', 'referral_code')) {
                $table->dropColumn('referral_code');
            }
        });
    }
};
