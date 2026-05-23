<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;

#[Fillable(['user_id', 'dob', 'gender', 'blood_group', 'address', 'emergency_contact'])]
class UserProfile extends Model
{
    public function user() {
        return $this->belongsTo(User::class);
    }
}
