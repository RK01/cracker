<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseSubCategory;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseSubjectController extends Controller
{
    public function index()
    {
       $subjects = Subject::orderBy('id', 'desc')
    ->get()
    ->groupBy('course_id')
    ->map(function ($courseItems) {

        return $courseItems
            ->groupBy('sub_course_id')
            ->map(function ($subCourseItems) {

                return [
                    'sub_course_id' => $subCourseItems->first()->sub_course_id,

                    'subjects' => $subCourseItems->map(function ($subject) {
                        return [
                            'id'   => $subject->id,
                            'name' => $subject->name,
                        ];
                    })->values(),
                ];
            })
            ->values();
    });


        $courses= Course::get() ?? new Course();
        return view('adminPanel.subjects.index', compact('subjects', 'courses'));
    }

    public function create()
    {
        $courses = Course::where('status', '1')->get();
        $subCategories = CourseSubCategory::get();
        return view('adminPanel.subjects.create', compact('courses', 'subCategories'));
    }

    // 2. AJAX Endpoint: Fetch Sub Categories based on Course ID
    public function getSubCategories($courseId)
    {
        $subCategories = CourseSubCategory::where('course_id', $courseId)->get(['id', 'name']);
    
        return response()->json($subCategories);
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'course_id'     => 'required|exists:courses,id',
            'sub_course_id' => 'nullable|integer',
            'subjects'      => 'required|array|min:1',
            'subjects.*'    => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            // Loop through dynamic multiple subjects input array
            foreach ($request->subjects as $subjectName) {
                Subject::create([
                    'course_id'     => $request->course_id,
                    'sub_course_id' => $request->sub_course_id ?? $request->course_id, // Default layout match fallback
                    'name'          => trim($subjectName),
                ]);
            }

            DB::commit();
            return redirect()->route('admin.subjects.index')->with('success', 'Multiple Subjects mapped successfully under Course Scope.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Execution Error: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $subject = Subject::findOrFail($id);
        $courses = Course::where('status', '1')->get();
        $subCategories = CourseSubCategory::where('course_id', $subject->course_id)->get();

        return view('adminPanel.subjects.edit', compact('subject', 'courses', 'subCategories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'course_id'     => 'required|exists:courses,id',
            'sub_course_id' => 'nullable|integer',
            'name'          => 'required|string|max:255',
        ]);

        $subject = Subject::findOrFail($id);
        $subject->update([
            'course_id'     => $request->course_id,
            'sub_course_id' => $request->sub_course_id ?? $request->course_id,
            'name'          => trim($request->name),
        ]);

        return redirect()->route('admin.subjects.index')->with('success', 'Subject parameters updated.');
    }

    public function destroy($id)
    {
        $subject = Subject::findOrFail($id);
        $subject->delete();
        return redirect()->route('admin.subjects.index')->with('success', 'Mapping reference detached.');
    }
}
