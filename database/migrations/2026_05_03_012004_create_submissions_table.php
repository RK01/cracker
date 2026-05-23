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
        Schema::create('submissions', function (Blueprint $table) {
                        
            $table->id();
            $table->foreignId('assignment_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->string('file_path');
            $table->text('comments_by_user')->nullable();
            $table->timestamp('submitted_at_user')->nullable();

            $table->text('comments_by_faculty')->nullable();
            $table->integer('score_by_faculty')->nullable(); // 0-100
            $table->timestamp('completed_at_faculty')->nullable();

            $table->enum('status', ['submitted', 'completed'])->default('submitted');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submissions');
    }
};
