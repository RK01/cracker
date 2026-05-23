<?php

namespace App\Http\Controllers\faculty;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\VideoLecture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class VideoLectureController extends Controller
{
    public function index()
    {

        $data['courses'] = Course::where('id', Auth::user()->course_id)->get() ?? new Course();
        $data['getAllVideoLectures'] = VideoLecture::where('uploaded_by', Auth::user()->id)->get();
        return view('facultyPanel.upload-video-lectures', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'sub_cat_course_id' => 'required|exists:course_sub_category,id',
            'subject_id' => 'required|exists:subjects,id',
            'chapter' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'video' => 'required|file|mimes:mp4,mkv,avi,mov',
            'visibility' => 'required|in:public,private',
        ]);

        $videoPath = $request->file('video')->store('videos', 'public');

        VideoLecture::create([
            'course_id' => $request->course_id,
            'sub_cat_course_id' => $request->sub_cat_course_id,
            'subject_id' => $request->subject_id,
            'chapter' => $request->chapter,
            'title' => $request->title,
            'description' => $request->description,
            'video_path' => $videoPath,
            'visibility' => $request->visibility,
            'uploaded_by' => Auth::user()->id,
        ]);

        return redirect()->back()->with('success', 'Video lecture uploaded successfully!');
    }

    public function edit(VideoLecture $videoLecture)
    {
        if ($videoLecture->uploaded_by !== auth()->id()) {
            abort(403);
        }
        return view('facultyPanel.edit-video-lecture', compact('videoLecture'));
    }

    /**
     * Manage the status (Publish/Draft)
     */
    public function manageStatus(VideoLecture $videoLecture, $status)
    {
        // Validate that the status being passed is allowed
        if (!in_array($status, ['published', 'draft'])) {
            return redirect()->back()->with('error', 'Invalid status.');
        }

        $videoLecture->update([
            'status' => $status
        ]);

        $message = $status == 'published' ? 'Lecture published successfully!' : 'Lecture moved to drafts.';

        return redirect()->back()->with('success', $message);
    }

    /**
     * Remove the lecture and the physical file
     */
    public function destroy(VideoLecture $videoLecture)
    {
        // 1. Delete the file from storage
        if (Storage::disk('public')->exists($videoLecture->video_path)) {
            Storage::disk('public')->delete($videoLecture->video_path);
        }

        // 2. Delete the record from database
        $videoLecture->delete();

        return redirect()->back()->with('success', 'Video lecture deleted successfully!');
    }
}
