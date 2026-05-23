<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;

#[Fillable(['title', 'subject_id', 'course_id', 'sub_cat_course_id', 'due_date','type', 'description', 'posted_by', 'file_path', 'file_size', 'page_count', 'posted_by'])]
class Assignment extends Model
{
    public function student()
    {
        return $this->hasMany(Submission::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }
}
