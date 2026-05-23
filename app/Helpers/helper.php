<?php

use Carbon\Carbon;

if (!function_exists('formatDate')) {
    function formatDate($date)
    {
        return \Carbon\Carbon::parse($date)->format('d M Y');
    }
}

function pre($date)
{
    echo '<pre>';
    print_r($date);
    echo '</pre>';
    die();
}

function mySubjectId(){
    return \App\Models\FacultyDetail::where('user_id', auth()->user()->id)->where('course_id',auth()->user()->course_id)->value('subject_id');
}

function mySubCourestIds(){
    return \App\Models\FacultyDetail::where('user_id', auth()->user()->id)->where('course_id',auth()->user()->course_id)->value('sub_course_ids');
}

function userNameById($id){
    return \App\Models\User::where('id', $id)->value('name');
}

function getCourseNameById($courseId)
{
    $course = \App\Models\Course::find($courseId);
    return $course ? $course->name : 'Unknown Course';
}
function getSubCatCourseNameById($courseId)
{
    $course = \App\Models\CourseSubCategory::find($courseId);
    return $course ? $course->name : 'Unknown Course';
}
function getSubjectNameById($subject_id)
{
    $course = \App\Models\Subject::find($subject_id);
    return $course ? $course->name : 'Unknown Subject';
}

function getCourseSubCategoriesByPurchase($course_sub_category_id)
    {
        return \App\Models\CourseSubCategory::select('name')
        ->where('course_id', auth()->user()->course_id)
        ->where('id', $course_sub_category_id)
        ->first();
    }


function hasPurchasedAnyCourse()
{
    if (!auth()->check()) return false;

    return \App\Models\CoursePurchase::where('user_id', auth()->id())
        ->where('payment_status', 'success')
        ->where(function ($query) {
            $query->whereNull('expiry_date') // lifetime course
                  ->orWhere('expiry_date', '>=', Carbon::now()); // not expired
        })
        ->exists();
}

function hasPurchasedThisCourse($course_sub_category_id)
{
    return \App\Models\CoursePurchase::where('user_id', auth()->id())
        ->where('course_id', auth()->user()->course_id)
        ->where('course_sub_category_id', $course_sub_category_id)
        ->where('payment_status', 'success')
        ->where(function ($query) {
            $query->whereNull('expiry_date') // lifetime course
                  ->orWhere('expiry_date', '>=', Carbon::now()); // not expired
        })
        ->exists();
}