<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

#[Fillable(['course_id', 'sub_cat_course_id', 'subject_id', 'chapter', 'title', 'description', 'video_path', 'visibility', 'status', 'views', 'uploaded_by'])]
#[Hidden(['created_at', 'updated_at', 'deleted_at'])]
class VideoLecture extends Model
{
    //
}
