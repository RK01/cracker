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
        Schema::create('study_materials', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('course_id'); // IIT JEE, NEET ..
            $table->string('sub_cat_course_id'); // one Years course, two year course
            $table->string('subject_id'); // physics, chemistry, maths, biology
            $table->string('type');    // pdf, ppt, notes, worksheet
            $table->text('description')->nullable();
            $table->date('due_date');
            $table->string('file_path');
            $table->unsignedBigInteger('posted_by');
            $table->string('file_size'); // e.g., 2.3 MB
            $table->integer('page_count')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('study_materials');
    }
};
