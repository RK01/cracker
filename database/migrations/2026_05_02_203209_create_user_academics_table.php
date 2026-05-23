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
        Schema::create('user_academics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('batch')->nullable();
            $table->string('school_name')->nullable();
            $table->string('class_year')->nullable();
            $table->string('board')->nullable();
            $table->integer('target_year')->nullable();
            $table->integer('math_score')->nullable();
            $table->integer('physics_score')->nullable();
            $table->integer('chemistry_score')->nullable();
            $table->integer('biology_score')->nullable();
            $table->text('achievements')->nullable();
            $table->text('goals')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_academics');
    }
};
