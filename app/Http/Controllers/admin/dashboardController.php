<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Course;
use App\Models\CourseSubCategory;
use App\Models\FacultyDetail;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Sabberworm\CSS\Rule\Rule;

class dashboardController extends Controller
{
    public function adminDashboard()
    {
        $data['courses'] = Course::get() ?? new Course();
        $data['subjects'] = Subject::get();
        $data['courseSubCategory'] = CourseSubCategory::get();
        return view('adminPanel.dashboard', $data);
    }
}
