<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * نسخة ثابتة من بيانات حساب الإيداع لحظة تقديم طلب السحب — حتى تبقى لدى
 * الإدارة كما كانت عند الطلب حتى لو غيّر المزوّد حساب الإيداع لاحقًا.
 * كلها nullable حفاظًا على الطلبات القديمة وتوافق البيئات.
 */
return new class extends Migration
{
    public function up()
    {
        Schema::table('commission_withdrawal_requests', function (Blueprint $table) {
            if (!Schema::hasColumn('commission_withdrawal_requests', 'account_holder_name')) {
                $table->string('account_holder_name')->nullable()->after('amount');
            }
            if (!Schema::hasColumn('commission_withdrawal_requests', 'iban')) {
                $table->string('iban', 34)->nullable()->after('account_holder_name');
            }
            if (!Schema::hasColumn('commission_withdrawal_requests', 'bank_name')) {
                $table->string('bank_name')->nullable()->after('iban');
            }
            if (!Schema::hasColumn('commission_withdrawal_requests', 'national_id')) {
                $table->string('national_id', 20)->nullable()->after('bank_name');
            }
        });
    }

    public function down()
    {
        Schema::table('commission_withdrawal_requests', function (Blueprint $table) {
            foreach (['account_holder_name', 'iban', 'bank_name', 'national_id'] as $column) {
                if (Schema::hasColumn('commission_withdrawal_requests', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
