<?php

namespace App\Models\test;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;

#[Fillable(['question_id', 'option_text', 'is_correct'])]

class Option extends Model
{
    public function question()
    {
        return $this->belongsTo(Question::class,'question_id');
    }
}
