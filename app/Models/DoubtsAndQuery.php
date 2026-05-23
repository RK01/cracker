<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
        'user_id',
        'course_id',
        'sub_cat_course_id',
        'subject_id',
        'title',
        'description',
        'image_path',
        'status',
        'is_urgent',
        'posted_by',
        'faculty_reply',
        'faculty_attachment'
    ])]
class DoubtsAndQuery extends Model
{
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
