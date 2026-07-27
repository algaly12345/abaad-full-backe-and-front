<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * جدول commissions موجود بالفعل يدويًا (فارغ) بحالات PENDING/AVAILABLE/
 * WITHDRAWN/CANCELLED فقط. نضيف حالة APPROVED (بين PENDING وAVAILABLE)
 * وعمودي approved_at/available_at لتوثيق تاريخ كل انتقال، حسب سيناريو
 * "قيد الانتظار → معتمدة → متاحة للسحب".
 */
return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('commissions')) {
            Schema::create('commissions', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->unsignedBigInteger('referral_id');
                $table->decimal('amount', 10, 2);
                $table->enum('status', ['PENDING', 'APPROVED', 'AVAILABLE', 'WITHDRAWN', 'CANCELLED'])
                    ->default('PENDING');
                $table->timestamp('approved_at')->nullable();
                $table->timestamp('available_at')->nullable();
                $table->timestamps();

                $table->index('user_id');
                $table->index('referral_id');
                $table->index('status');
            });

            return;
        }

        // الجدول موجود مسبقًا بدون حالة APPROVED — نوسّع الـ enum عبر SQL خام
        // (تعديل enum في MySQL لا يمكن التراجع عنه بأمان عبر Blueprint::change()
        // بدون doctrine/dbal، لذلك نستخدم ALTER TABLE مباشرة).
        DB::statement("ALTER TABLE commissions MODIFY status ENUM('PENDING','APPROVED','AVAILABLE','WITHDRAWN','CANCELLED') NOT NULL DEFAULT 'PENDING'");

        if (!Schema::hasColumn('commissions', 'approved_at')) {
            Schema::table('commissions', function (Blueprint $table) {
                $table->timestamp('approved_at')->nullable()->after('status');
            });
        }

        if (!Schema::hasColumn('commissions', 'available_at')) {
            Schema::table('commissions', function (Blueprint $table) {
                $table->timestamp('available_at')->nullable()->after('approved_at');
            });
        }
    }

    public function down()
    {
        Schema::table('commissions', function (Blueprint $table) {
            if (Schema::hasColumn('commissions', 'approved_at')) {
                $table->dropColumn('approved_at');
            }
            if (Schema::hasColumn('commissions', 'available_at')) {
                $table->dropColumn('available_at');
            }
        });

        DB::statement("ALTER TABLE commissions MODIFY status ENUM('PENDING','AVAILABLE','WITHDRAWN','CANCELLED') NOT NULL DEFAULT 'PENDING'");
    }
};
