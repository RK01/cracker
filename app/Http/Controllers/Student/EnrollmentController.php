<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        // 1. Current Enrollment (Latest active course)
        $currentEnrollment = Enrollment::where('student_id', $userId)
            ->with('course')
            ->latest()
            ->first();

        // 2. Available Courses (Jo user ne abhi enroll nahi kiye)
        $enrolledIds = Enrollment::where('student_id', $userId)->pluck('course_id');
        $availableCourses = Course::whereNotIn('id', $enrolledIds)->paginate(10);

        // 3. Enrollment History
        $history = Enrollment::where('student_id', $userId)
            ->with('course')
            ->orderBy('id', 'desc')
            ->get();

        return view('studentPanel.enrollment', compact('currentEnrollment', 'availableCourses', 'history'));
    }
}
