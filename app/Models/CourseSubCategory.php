<?php

namespace App\Models;

use App\Models\test\Test;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['course_id', 'name'])]

class CourseSubCategory extends Model
{
    protected $table = 'course_sub_category';

    // Relationship: SubCategory belongs to Course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function courseDetail()
    {
        return $this->hasOne(CourseDetail::class, 'course_sub_category_id');
    }

    public function subjects()
    {
        return $this->hasMany(Subject::class, 'course_id');
    }

    public function test()
    {
        return $this->hasMany(Test::class, 'sub_cat_course_id');
    }
}