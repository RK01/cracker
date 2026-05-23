<?php

namespace App\Models\test;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;

#[Fillable(['test_id', 'question_text'])]

class Question extends Model
{
    public function options() { return $this->hasMany(Option::class); }

    public function test()
    {
        return $this->belongsTo(Test::class,'test_id');
    }
}
