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
        Schema::create('Services', function (Blueprint $table) {
            $table->id();
			$table->foreignId('service_category_id')->constrained('service_categories')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('title')->nullable();
			$table->string('name');
            $table->string('slug');
            $table->string('image')->nullable();
            $table->text('icon')->nullable();
			$table->text('short_description')->nullable();
			$table->text('description')->nullable();
			$table->integer('order_level')->default(0);
			$table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Services');
    }
};
