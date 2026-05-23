<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

#[Fillable([
        'course_sub_category_id',
        'title',
        'description',
        'image',
        'duration',
        'batch_size',
        'price',
        'includes',
        'highlights',
        'syllabus',
        'what_you_get'
    ])]

class CourseDetail extends Model
{
    protected $table = 'course_details';

   

    // ✅ JSON cast (VERY IMPORTANT)
    protected $casts = [
        'includes' => 'array',
        'highlights' => 'array',
        'syllabus' => 'array',
        'what_you_get' => 'array',
    ];

    // 🔗 Relation
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function CourseSubCategory()
    {
        return $this->belongsTo(CourseSubCategory::class);
    }
    
}