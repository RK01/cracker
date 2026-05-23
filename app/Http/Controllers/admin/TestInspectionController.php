<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CourseSubCategory;
use App\Models\test\Test;
use Illuminate\Http\Request;

class TestInspectionController extends Controller
{
     public function inspectTests()
    {
        $tests = CourseSubCategory::with('test.attempts.responses')->orderBy('id', 'desc')->get();
        
        // $tests = CourseSubCategory::with('test.attempts', 'test.questions.options')->where('course_id', Auth::user()->course_id)->get();
        return view('adminPanel.test.test-inspect', compact('tests',));
    }

    public function showDetails($id)
    {
        // Eager loading all required dependency entities to bypass N+1 query loops
        $test = Test::with(['questions.options', 'attempts.responses'])->findOrFail($id);

        return view('adminPanel.test.test-review', compact('test'));
    }
}
