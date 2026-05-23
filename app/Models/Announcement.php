<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;

#[Fillable(['announcement_title', 'announcement_message', 'course_id', 'priority', 'file','posted_by'])]
class Announcement extends Model
{
    public function readAnnouncements() {
        return $this->belongsToMany(Announcement::class, 'announcement_student', 'user_id', 'announcement_id')->withTimestamps();
    }

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
