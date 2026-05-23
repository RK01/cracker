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
        Schema::create('doubts_and_queries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Foreign key for user
            $table->unsignedBigInteger('course_id'); // Foreign key for course
            $table->unsignedBigInteger('sub_cat_course_id'); // Foreign key for sub-category course
            $table->unsignedBigInteger('subject_id'); // Foreign key for subject
            $table->string('title'); // Title of the query
            $table->text('description'); // Description of the query
            $table->string('image_path')->nullable(); // Optional image path
            $table->enum('status', ['open', 'resolved', 'closed'])->default('open'); // Status of the query
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('sub_cat_course_id')->references('id')->on('course_sub_categories')->onDelete('cascade');
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doubts_and_queries');
    }
};
