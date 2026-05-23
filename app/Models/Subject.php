<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'subjects';

   protected $fillable = ['name', 'course_id', 'section'];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
