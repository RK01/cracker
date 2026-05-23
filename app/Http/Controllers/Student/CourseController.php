<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseDetail;
use App\Models\CoursePurchase;
use App\Models\CourseSubCategory;
use App\Models\enrollments;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    public function courses()
    {
        // $courses = CourseSubCategory::with(['courseDetails', 'subjects'])->where('course_id', Auth::user()->course_id)->get();
        $courses = CourseSubCategory::with('courseDetail')->where('course_id', Auth::user()->course_id)->get();
        return view('studentPanel.courses', compact('courses'));
    }

    public function courses_details($id)
    {
        $id = decrypt($id);
        $courseDetails = CourseDetail::findOrFail($id);
        return view('studentPanel.courses-details', compact('courseDetails'));
    }

    public function paymentPage($id)
    {
        $id = decrypt($id);
        $course = CourseDetail::findOrFail($id);
        
        return view('studentPanel.payment', compact('course'));
    }

    public function buy(Request $request, $id)
    {
    
        $id = decrypt($id);
        $user = auth()->user();
        $course = CourseDetail::findOrFail($id);
        
        // Already purchased check
       $alreadyPurchased = CoursePurchase::where('user_id', $user->id)
        ->where('course_id', $course->course_id)
        ->where('course_sub_category_id', $course->course_sub_category_id)
        ->where('payment_status', 'success')
        ->exists();

        if ($alreadyPurchased) {
            return redirect()->back()->with('error', 'You already purchased this course.');
        }

        try {
            DB::beginTransaction();

            // 👉 yahan future me payment gateway integrate hoga
            // user ko email jega
            // admin ko notification jaege 
        
           
            $amount = preg_replace('/[^0-9]/', '', $course->price);
            $amount = (int) $amount;

            $discount = 0;
            $finalAmount = $amount - $discount;

            
            
            $purchase = CoursePurchase::create([
                'user_id' => $user->id,
                'course_id' => Auth::user()->course_id,
                'course_sub_category_id' => $course->course_sub_category_id,

                'amount' => $amount,
                'discount' => $discount,
                'final_amount' => $finalAmount,

                'payment_status' => 'success',
                'payment_method' => 'manual',
                'transaction_id' => uniqid('TXN_'),
                'purchase_date' => now(),
            ]);
                
            DB::commit();
            return redirect()->route('student.orders')->with('success', 'Course purchased successfully!');

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }
}