<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Course extends Model
{
    use HasFactory;
    protected $table = 'courses';

    protected $fillable = ['name','course_id'];

    public function subCategories()
    {
        return $this->hasMany(CourseSubCategory::class);
    }

    public function subjects()
    {
        return $this->hasMany(Subject::class, 'course_id');
    }

    public function purchases()
    {
        return $this->hasMany(CoursePurchase::class);
    }

    public function details()
    {
        return $this->hasMany(CourseDetail::class);
    }

    
}
