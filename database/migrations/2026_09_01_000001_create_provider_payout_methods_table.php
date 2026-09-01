<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * حساب الإيداع المحفوظ لمزوّد الخدمة (يُستخدم لصرف عمولات الإحالة).
 * صف واحد لكل مستخدم (user_id فريد)، يُحدَّث عند كل طلب سحب بالقيم التي
 * أدخلها المزوّد في ورقة السحب، وتُنسخ لحظتها إلى صف طلب السحب نفسه.
 */
return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('provider_payout_methods')) {
            Schema::create('provider_payout_methods', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id')->unique();
                $table->string('account_holder_name');
                $table->string('iban', 34);
                $table->string('bank_name');
                $table->string('national_id', 20);
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('provider_payout_methods');
    }
};
