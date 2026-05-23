<?php

namespace App\Http\Controllers\faculty;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AllocatedCourseController extends Controller
{
    public function index(Request $request){
        
        $data['cources'] = CourseSubCategory::with(['courseDetail', 'subjects'])
    ->where('course_id', Auth::user()->course_id)
    ->get();

        return view('facultyPanel.course-allocation', $data);
    }
}
