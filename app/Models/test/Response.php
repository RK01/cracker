<?php

namespace App\Models\test;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;

#[Fillable(['attempt_id', 'question_id', 'option_id'])]

class Response extends Model
{
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function option()
    {
        return $this->belongsTo(Option::class);
    }

    public function attempt()
    {
        return $this->belongsTo(Attempt::class,'attempt_id');
    }
}
