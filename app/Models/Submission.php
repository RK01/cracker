<?php

namespace App\Models;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


#[Fillable(['assignment_id', 'user_id', 'file_path', 'comments_by_user', 'submitted_at_user', 'comments_by_faculty', 'score_by_faculty', 'completed_at_faculty', 'status'])]
class Submission extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assignment()
    {
        return $this->belongsTo(Assignment::class);
    }

    public function submmited()
    {
        return $this->belongsTo(Assignment::class);
    }
}
