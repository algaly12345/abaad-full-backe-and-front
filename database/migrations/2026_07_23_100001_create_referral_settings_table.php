<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * جدول referral_settings موجود بالفعل في قاعدة البيانات (أُنشئ يدويًا خارج
 * الـ migrations) بأعمدة reward_type/reward_value/attribution_window_days/
 * min_payout_limit. هذه الـ migration idempotent: تُنشئ الجدول فقط إن لم
 * يكن موجودًا، وتضيف عمود commission_hold_days إن لم يكن موجودًا، ثم تضبط
 * الصف الوحيد على نسبة 10% بدل القيمة الثابتة 50 ريال الحالية.
 */
return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('referral_settings')) {
            Schema::create('referral_settings', function (Blueprint $table) {
                $table->id();
                $table->enum('reward_type', ['FIXED', 'PERCENTAGE'])->default('FIXED');
                $table->decimal('reward_value', 10, 2)->default(50.00);
                $table->integer('attribution_window_days')->default(30);
                $table->decimal('min_payout_limit', 10, 2)->default(0.00);
                $table->timestamps();
            });
        }

        if (!Schema::hasColumn('referral_settings', 'commission_hold_days')) {
            Schema::table('referral_settings', function (Blueprint $table) {
                // مدة انتظار "قيد الانتظار" قبل الاعتماد التلقائي للمكافأة،
                // قابلة للتعديل من الإعدادات فقط (لا قيمة افتراضية مفروضة بالكود).
                $table->integer('commission_hold_days')->nullable()->after('min_payout_limit');
            });
        }

        // نموذج أبعاد المعتمد: 10% من صافي المبلغ المدفوع، أول اشتراك فقط.
        if (DB::table('referral_settings')->count() === 0) {
            DB::table('referral_settings')->insert([
                'reward_type' => 'PERCENTAGE',
                'reward_value' => 10.00,
                'attribution_window_days' => 30,
                'min_payout_limit' => 0.00,
                'commission_hold_days' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } else {
            DB::table('referral_settings')->update([
                'reward_type' => 'PERCENTAGE',
                'reward_value' => 10.00,
                'commission_hold_days' => DB::raw('COALESCE(commission_hold_days, 10)'),
                'updated_at' => now(),
            ]);
        }
    }

    public function down()
    {
        Schema::table('referral_settings', function (Blueprint $table) {
            if (Schema::hasColumn('referral_settings', 'commission_hold_days')) {
                $table->dropColumn('commission_hold_days');
            }
        });
    }
};
