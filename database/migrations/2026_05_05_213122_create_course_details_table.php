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
        Schema::create('course_details', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('course_id')->constrained()->cascadeOnDelete();
            $table->string('title');

            $table->text('description')->nullable();
            $table->string('image')->nullable();

            $table->string('duration')->nullable();
            $table->integer('batch_size')->nullable();
            $table->decimal('price', 10, 2)->default(0);
            $table->json('includes')->nullable();

            $table->json('highlights')->nullable();
            $table->json('syllabus')->nullable();
            $table->json('what_you_get')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_details');
    }
};
