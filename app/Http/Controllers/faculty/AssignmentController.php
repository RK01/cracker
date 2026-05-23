<?php

namespace App\Http\Controllers\faculty;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Course;
use App\Models\Course_name;
use App\Models\CourseSubCategory;
use App\Models\StudyMaterial;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;

class AssignmentController extends Controller
{

    public function resources_upload()
    {
        $data['courses'] = Course::where('id', Auth::user()->course_id)->get() ?? new Course();
        $data['courseSubCategory'] = CourseSubCategory::where('course_id', Auth::user()->course_id)->get();
        $studyMaterials = StudyMaterial::where('posted_by', auth()->id())->get();
        $assignments = Assignment::where('posted_by', auth()->id())->get();
        $combined = $studyMaterials->concat($assignments)->sortByDesc('created_at')->values();

        // Manual pagination
        $page = request()->get('page', 1);
        $perPage = 10;
        $paginated = new LengthAwarePaginator(
            $combined->forPage($page, $perPage),
            $combined->count(),
            $perPage,
            $page,
            ['path' => request()->url()]
        );
        $data['combined'] = $paginated;
        $data['totalstudyMaterials'] = $studyMaterials->count();
        $data['totalstudyAssignments'] = $assignments->count();
    
        return view('facultyPanel.upload-resources', $data);
    }   

    public function store_study_materials(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'course_id' => 'required|exists:courses,id',
            'sub_cat_course_id' => 'required',
            'subject_id' => 'required',
            'type' => 'required|string',
            'due_date' => 'required|date',
            'file' => 'nullable|file|mimes:pdf,docx,zip|max:102400'
        ]);

        $path = null;
        $fileSize = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            
            $fileSize = $file->getSize();
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/studyMaterials'), $fileName);
            $path = 'studyMaterials/' . $fileName;
        }

        $created = StudyMaterial::create([
            'title' => $request->title,
            'course_id' => $request->course_id,
            'sub_cat_course_id' => $request->sub_cat_course_id,
            'subject_id' => $request->subject_id,
            'type' => $request->type,
            'description'=> $request->description,
            'due_date' => $request->due_date,
            'file_path' => $path,
            'file_size' => $fileSize,
            'posted_by' => Auth::id(),
            'page_count' => null, 
        ]);
        if (!$created) {
            return redirect()->back()->with('error', 'Failed to create Study Material. Please try again.');
        }else{
            return redirect()->back()->with('success', 'Study Material created successfully!');
        }

    }

    public function store_assignments(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'course_id' => 'required',
            'sub_cat_course_id' => 'required',
            'subject_id' => 'required',
            'type' => 'required|string',
            'due_date' => 'required|date',
            'assignmentFile' => 'nullable|file|mimes:pdf,docx,zip|max:102400'
        ]);
    
        // File Upload
        $path = null;
        $fileSize = null;
        if ($request->hasFile('assignmentFile')) {
            $file = $request->file('assignmentFile');
            
            $fileSize = $file->getSize();
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/assignment'), $fileName);
            $path = 'assignment/' . $fileName;
        }

        $created = Assignment::create([
            'title' => $request->title,
            'type' => $request->type,
            'due_date' => $request->due_date,
            'sub_cat_course_id' => $request->sub_cat_course_id,
            'subject_id' => $request->subject_id,
            'description'=> $request->description,

            'course_id' => $request->course_id,
            'file_path' => $path,
            'file_size' => $fileSize,
            'posted_by' => Auth::id(),
            'page_count' => null, 
        ]);
        if (!$created) {
            return redirect()->back()->with('error', 'Failed to create assignment. Please try again.');
        }else{
            return redirect()->back()->with('success', 'Assignment created successfully!');
        }

    }
    
}
