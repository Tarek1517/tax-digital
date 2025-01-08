<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('package_id');
            $table->foreign('package_id')->references('id')->on('packages')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('package_name');
            $table->string('order_code')->nullable();
            $table->string('companey_name');
            $table->string('cus_name');
            $table->string('cus_phone');
            $table->string('cus_email');
            $table->enum('order_status', ['pending','accept'])->default("pending");
            $table->float('total_payment')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('payment_intent_id')->nullable();
            $table->string('checkout_session_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
