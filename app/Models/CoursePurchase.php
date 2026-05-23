<?php

namespace App\Models;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


#[Fillable(['user_id', 'course_id', 'course_sub_category_id', 'amount', 'discount', 'final_amount', 'payment_status', 'payment_method', 'transaction_id', 'purchase_date', 'expiry_date','status'])]
class CoursePurchase extends Model
{
    // Relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
