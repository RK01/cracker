<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseDetail;
use App\Models\CourseSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule as ValidationRule;
use Sabberworm\CSS\Rule\Rule;

class CourseDetailController extends Controller
{
    public function index()
    {
        $details = CourseDetail::with('CourseSubCategory.course')->latest()->paginate(10);
        return view('adminPanel.course_details.index', compact('details'));
    }

    public function create()
    {
        $courses = Course::get() ?? new Course();
        $subCategories = CourseSubCategory::with('course')->get();
        return view('adminPanel.course_details.create', compact('subCategories', 'courses'));
    }

    public function store(Request $request)
    {
        // 1. Validation Matrix (Conditional validation logic based on course_mode selection)
        $request->validate([
            'course_mode'    => 'required|in:existing,new',
            'course_id'      => 'required_if:course_mode,existing|nullable|exists:courses,id',
            'sub_course_id'  => 'required_if:course_mode,existing|nullable|exists:course_sub_category_id,id',
            // 'sub_course_id'  => 'required_if:course_mode,existing|nullable',
            
            'course_name'    => 'required_if:course_mode,new|nullable|string|max:255|unique:courses,name',
            'status'         => 'required_if:course_mode,new|nullable|in:active,inactive',
            // 'sub_cat_name'   => 'required_if:course_mode,new|nullable|string|max:255|unique:course_sub_category,name',
            'sub_cat_name'   => [
                'required_if:course_mode,new',
                'nullable',
                'string',
                'max:255',
                ValidationRule::unique('course_sub_category', 'name')->where(function ($query) {
                    return $query->where('course_id', request('course_id'));
                }),
            ],
            
            'title'          => 'required|string|max:255',
            'description'    => 'required|string',
            'image'          => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'duration'       => 'required|string|max:100',
            'batch_size'     => 'required|string|max:100',
            'price'          => 'required|string|max:100',
            'includes'       => 'required|array|min:1',
            'highlights'     => 'required|array|min:1',
            'syllabus'       => 'required|array|min:1',
            'what_you_get'   => 'required|array|min:1',
        ]);

        DB::beginTransaction();

        try {
            $finalSubCategoryId = null;

            if ($request->course_mode === 'new') {
                
                // Step 1: Create fresh Master Course node
                $course = Course::create([
                    'name'   => $request->course_name,
                    'status' => $request->status,
                ]);

                // Step 2: Create a fresh Sub-Category under this newly instantiated Master Course
                $subCategory = CourseSubCategory::create([
                    'course_id' => $course->id,
                    'name'      => $request->sub_cat_name,
                ]);
                $finalSubCategoryId = $subCategory->id;
            } else {
                // Step 1 Alternative: Directly capture selected dependent ID node from layout dropdown
                $finalSubCategoryId = $request->sub_course_id;
            }

            // Image Storage Handler
            $imageName = null;
            if ($request->hasFile('image')) {
                $imageName = time() . '-' . $request->file('image')->getClientOriginalName();
                $request->file('image')->move(public_path('uploads/courses'), $imageName);
            }

            // Step 3: Insert exact final entity details into CourseDetails relational tree schema
            CourseDetail::create([
                'course_sub_category_id' => $finalSubCategoryId,
                'title'                  => $request->title,
                'description'            => $request->description,
                'image'                  => $imageName,
                'duration'               => $request->duration,
                'batch_size'             => $request->batch_size,
                'price'                  => $request->price,
                'includes'               => $request->includes,
                'highlights'             => $request->highlights,
                'syllabus'               => $request->syllabus,
                'what_you_get'           => $request->what_you_get,
            ]);

            DB::commit();
            return redirect()->route('admin.course-details.index')->with('success', 'Course structure linked and instantiated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Multi-Table Insertion Failed: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Deployment failed: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $courseDetail = CourseDetail::findOrFail($id);
        $subCategories = CourseSubCategory::with('course')->get();
        return view('adminPanel.course_details.edit', compact('courseDetail', 'subCategories'));
    }

    public function update(Request $request, $id)
    {
        $courseDetail = CourseDetail::findOrFail($id);

        $request->validate([
            'course_sub_category_id' => 'required|exists:course_sub_category,id|unique:course_details,course_sub_category_id,' . $id,
            'title'        => 'required|string|max:255',
            'description'  => 'required|string',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'duration'     => 'required|string|max:100',
            'batch_size'   => 'required|string|max:100',
            'price'        => 'required|string|max:100',
            'includes'     => 'required|array|min:1',
            'highlights'   => 'required|array|min:1',
            'syllabus'     => 'required|array|min:1',
            'what_you_get' => 'required|array|min:1',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            // Remove Old Resource safely from server block if exists
            if ($courseDetail->image && file_exists(public_path('uploads/courses/' . $courseDetail->image))) {
                @unlink(public_path('uploads/courses/' . $courseDetail->image));
            }

            $imageName = time() . '-' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('uploads/courses'), $imageName);
            $data['image'] = $imageName;
        } else {
            $data['image'] = $courseDetail->image;
        }

        $courseDetail->update($data);

        return redirect()->route('admin.course-details.index')->with('success', 'Course architecture alignment updated.');
    }

    public function destroy($id)
    {
        $courseDetail = CourseDetail::findOrFail($id);

        if ($courseDetail->image && file_exists(public_path('uploads/courses/' . $courseDetail->image))) {
            @unlink(public_path('uploads/courses/' . $courseDetail->image));
        }

        $courseDetail->delete();

        return redirect()->route('admin.course-details.index')->with('success', 'Resource collection entry removed.');
    }
}
