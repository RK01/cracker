<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;



#[Fillable(['user_id','user_id', 'course_id', 'sub_course_ids', 'subject_id', 'state', 'city', 'qualification', 'years_of_experience', 'bio',])]

class FacultyDetail extends Model
{
    protected $casts = [
        'sub_course_ids' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
