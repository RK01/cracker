<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseSubCategory;
use App\Models\DoubtsAndQuery;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoubtsAndQueriesController extends Controller
{
    public function index()
{
    $userId = Auth::id();
    $courseId = Auth::user()->course_id;

    // Fetch master data for modal
    $data['courses'] = Course::where('id', $courseId)->get();
    $data['subjects'] = Subject::where('course_id', $courseId)->get();
    $data['courseSubCategory'] = CourseSubCategory::where('course_id', $courseId)->get();

    // Fetch user doubts with subject relationship
    $allDoubts = DoubtsAndQuery::with('subject')
                ->where('user_id', $userId)
                ->orderBy('created_at', 'desc')
                ->get();

    // Stats & Collections
    $data['allDoubts'] = $allDoubts;
    $data['pendingDoubts'] = $allDoubts->whereIn('status', ['open', 'pending']);
    $data['resolvedDoubts'] = $allDoubts->where('status', 'resolved');
    
    $data['totalCount'] = $allDoubts->count();
    $data['resolvedCount'] = $data['resolvedDoubts']->count();
    $data['pendingCount'] = $data['pendingDoubts']->count();

    return view('studentPanel.doubts', $data);
}


    public function store(Request $request)
    {
        $request->validate([
            'course_id'           => 'required|exists:courses,id',
            'sub_cat_course_id'   => 'required',
            'subject_id'          => 'required|exists:subjects,id',
            'title'               => 'required|string|max:255',
            'description'         => 'required|string',
            'is_urgent'           => 'nullable|boolean',
            'file'                => 'nullable|image|mimes:jpg,jpeg,png,pdf|max:5120' // 5MB limit
        ]);

        
        $path = null;
        $fileSize = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            
            $fileSize = $file->getSize();
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/doubtsAndQuery'), $fileName);
            $path = 'doubtsAndQuery/' . $fileName;
        }




        $created = DoubtsAndQuery::create([
            'user_id'           => auth()->id(), // Database ke user_id ke liye
            'course_id'         => $request->course_id,
            'sub_cat_course_id' => $request->sub_cat_course_id,
            'subject_id'        => $request->subject_id,
            'title'             => $request->title,
            'description'       => $request->description,
            'is_urgent'         => $request->is_urgent ?? 0,
            'image_path'        => $path, // Database column 'image_path' hai
            'posted_by'         => auth()->id(), // Migration ke mutabiq
            'status'            => 'open',
        ]);

        if ($created) {
            return redirect()->back()->with('success', 'Your doubt has been submitted successfully!');
        }

        return redirect()->back()->with('error', 'Something went wrong. Please try again.');
    }
}
