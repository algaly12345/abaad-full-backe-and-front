<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('commission_withdrawal_requests')) {
            Schema::create('commission_withdrawal_requests', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->decimal('amount', 10, 2);
                $table->enum('status', ['pending', 'approved', 'rejected', 'paid'])->default('pending');
                $table->timestamp('requested_at')->nullable();
                $table->timestamp('processed_at')->nullable();
                $table->text('note')->nullable();
                $table->timestamps();

                $table->index('user_id');
                $table->index('status');
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('commission_withdrawal_requests');
    }
};
