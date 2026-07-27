<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * wallet_transactions.id كان عمودًا عاديًا بدون PRIMARY KEY ولا AUTO_INCREMENT
 * (الجدول أُنشئ يدويًا واستُخدم للقراءة فقط عبر WalletController::transactions
 * حتى الآن). نظام مكافآت الإحالة أول من يكتب فعليًا في هذا الجدول (لتسجيل
 * إضافة العمولة للمحفظة)، فيلزم مفتاح أساسي تلقائي الترقيم لعمل INSERT بدون
 * تمرير id يدويًا.
 */
return new class extends Migration
{
    public function up()
    {
        if (Schema::hasTable('wallet_transactions')) {
            $hasPrimaryKey = collect(DB::select('SHOW KEYS FROM wallet_transactions WHERE Key_name = "PRIMARY"'))->isNotEmpty();

            if (!$hasPrimaryKey) {
                // صفوف قديمة تحمل '0000-00-00 00:00:00' (غير صالحة تحت الوضع
                // الصارم الحالي) تمنع MySQL من إعادة بناء الجدول لإضافة
                // AUTO_INCREMENT. نصححها إلى created_at/الآن قبل المتابعة.
                DB::statement("UPDATE wallet_transactions SET created_at = NOW() WHERE created_at = '0000-00-00 00:00:00' OR created_at IS NULL");
                DB::statement("UPDATE wallet_transactions SET updated_at = created_at WHERE updated_at = '0000-00-00 00:00:00' OR updated_at IS NULL");

                DB::statement('ALTER TABLE wallet_transactions MODIFY id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT, ADD PRIMARY KEY (id)');
            }
        }
    }

    public function down()
    {
        // لا تراجع آمن يعيد الجدول لحالته غير الصالحة أصلًا للكتابة.
    }
};
