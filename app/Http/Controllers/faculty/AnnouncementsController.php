<?php

namespace App\Http\Controllers\faculty;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Course;
use App\Models\CourseSubCategory;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnouncementsController extends Controller
{
    public function announcements()
    {
        $data['courses'] = Course::where('id', Auth::user()->course_id)->get() ?? new Course();
        $data['announcements'] = Announcement::where('posted_by', Auth::id())->get();
        $data['subjects'] = Subject::where('course_id', auth()->user()->course_id)->get();
        $data['courseSubCategory'] = CourseSubCategory::where('course_id', Auth::user()->course_id)->get();
        return view('facultyPanel.announcements', $data);
    }

    public function announcement_store(Request $request)
    {
        try {

            $request->validate([
                'announcement_title' => 'required|string|max:255',
                'announcement_message' => 'required|string',
                'course_id' => 'required',
                'priority' => 'required|in:normal,high',
                'posted_by' => 'required|string|max:255',
                'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            ]);
            $fileName = null;
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('storage/announcements'), $fileName);
            }

            Announcement::create([
                'announcement_title' => $request->announcement_title,
                'announcement_message' => $request->announcement_message,
                'course_id' => $request->course_id,
                'priority' => $request->priority,
                'posted_by' => Auth::id(),
                'file' => $fileName,
            ]);

            return back()->with('success', 'Announcement Published Successfully');
        } catch (\Illuminate\Validation\ValidationException $e) {

            return back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {

            return back()->with('error', $e->getMessage())->withInput();
        }
    }
}
