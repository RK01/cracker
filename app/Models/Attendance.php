<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;

#[Fillable(['user_id','subject','date','status'])]
class Attendance extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
