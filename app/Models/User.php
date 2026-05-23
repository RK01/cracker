<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'phone', 'role', 'course_id', 'state', 'city', 'username'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function profile() {
        return $this->hasOne(UserProfile::class);
    }

    public function academic() {
        return $this->hasOne(UserAcademic::class);
    }

    public function readAnnouncements()
    {
        return $this->belongsToMany(Announcement::class, 'announcement_student');
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function facultyDetail()
    {
        return $this->hasOne(FacultyDetail::class);
    }

    /**
     * Get all submissions for the user.
     */
    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }

    public function purchases()
    {
        return $this->hasMany(CoursePurchase::class);
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }


}