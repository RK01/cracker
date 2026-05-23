<?php

namespace App\Models\test;

use App\Models\Course;
use App\Models\CourseDetail;
use App\Models\CourseSubCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;

#[Fillable(['title', 'course_id', 'sub_cat_course_id', 'duration_minutes', 'created_by', 'description'])]

class Test extends Model
{
    public function questions() { return $this->hasMany(Question::class); }

    public function course() { return $this->belongsTo(Course::class); }

    public function CourseSubCategory()
    {
        return $this->belongsTo(CourseSubCategory::class);
    }

    public function attempts()
    {
        return $this->hasMany(Attempt::class,'test_id');
    }

    public function response()
    {
        return $this->hasMany(Response::class,'attempt_id');
    }
}
