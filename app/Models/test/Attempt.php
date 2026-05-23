<?php

namespace App\Models\test;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;

#[Fillable(['user_id', 'test_id', 'score', 'status'])]

class Attempt extends Model
{
    public function responses()
    {
        return $this->hasMany(Response::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
   
    public function test()
    {
        return $this->belongsTo(Test::class, 'test_id');
    }
}
