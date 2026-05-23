<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

#[Fillable(['user_id', 'study_material_id', 'downloaded_at'])]

class DownloadLog extends Model
{
    protected $casts = [
        'downloaded_at' => 'datetime',
    ];

    public function material()
    {
        return $this->belongsTo(StudyMaterial::class, 'study_material_id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
