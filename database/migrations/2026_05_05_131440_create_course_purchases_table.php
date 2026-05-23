<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('course_purchases', function (Blueprint $table) {
            $table->id();

            // Relations
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('course_id')->constrained()->cascadeOnDelete();
            $table->foreignId('course_sub_category_id')->constrained()->cascadeOnDelete();

            // Pricing
            $table->decimal('amount', 10, 2);
            $table->decimal('discount', 10, 2)->default(0);
            $table->decimal('final_amount', 10, 2);

            // Payment
            $table->enum('payment_status', ['pending', 'success', 'failed', 'refunded'])->default('pending');
            $table->string('payment_method')->nullable();
            $table->string('transaction_id')->nullable();

            // Dates
            $table->timestamp('purchase_date')->useCurrent();
            $table->timestamp('expiry_date')->nullable();

            // Status
            $table->boolean('status')->default(true);

            $table->timestamps();

            // Optional: duplicate purchase avoid
            $table->unique(['user_id', 'course_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('course_purchases');
    }
};