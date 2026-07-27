<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * جدول referrals موجود بالفعل يدويًا في قاعدة البيانات (فارغ، بدون migration).
 * هذه الـ migration idempotent لضمان وجوده في أي بيئة جديدة بنفس البنية.
 */
return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('referrals')) {
            Schema::create('referrals', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('referrer_id');
                $table->unsignedBigInteger('referred_id')->unique();
                $table->enum('status', ['PENDING_PAYMENT', 'COMPLETED', 'REJECTED', 'EXPIRED'])
                    ->default('PENDING_PAYMENT');
                $table->timestamps();

                $table->index('referrer_id');
                $table->index('status');
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('referrals');
    }
};
