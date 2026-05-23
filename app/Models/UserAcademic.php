<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

#[Fillable(['user_id', 'batch', 'school_name', 'class_year', 'board', 'target_year', 'math_score', 'physics_score', 'chemistry_score', 'biology_score', 'achievements', 'goals'])]
class UserAcademic extends Model
{
    public function user() {
        return $this->belongsTo(User::class);
    }
}
