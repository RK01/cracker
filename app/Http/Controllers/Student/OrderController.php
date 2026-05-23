<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\CoursePurchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function myOrder()
    {
        // Student ke saare purchased courses fetch karein
        // Hum unique 'course_id' fetch karenge taaki ek hi course baar-baar na dikhe
        $orders = CoursePurchase::with('course')
            ->where('user_id', Auth::id())
            ->where('course_id', Auth::user()->course_id)
            ->latest()
            ->get();

        return view('studentPanel.my-orders', compact('orders'));
    }
}
