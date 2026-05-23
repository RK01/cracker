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
        Schema::create('video_lectures', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('sub_cat_course_id');
            $table->unsignedBigInteger('subject_id');
            $table->string('chapter');
            $table->string('title');
            $table->text('description');
            $table->string('video_path');
            $table->enum('visibility', ['public', 'private'])->default('public');
            $table->enum('status', ['published', 'draft'])->default('draft');
            $table->integer('views')->default(0);
            $table->timestamps();
            $table->unsignedBigInteger('uploaded_by');
            $table->foreign('uploaded_by')->references('id')->on('users')->onDelete('cascade');

            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('sub_cat_course_id')->references('id')->on('course_sub_category')->onDelete('cascade');
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('video_lectures');
    }
};
