<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\CoursePurchase;
use App\Models\VideoLecture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VideoLectureController extends Controller
{
    public function index(Request $request)
    {
        $subCourseIds = CoursePurchase::where('user_id', Auth::id())
            ->pluck('course_sub_category_id')
            ->toArray();

        $query = VideoLecture::where('course_id', Auth::user()->course_id)
            ->whereIn('sub_cat_course_id', $subCourseIds)
            ->where('status', 'published');

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('chapter', 'like', '%' . $request->search . '%');
            });
        }

        // Subject Filter
        if ($request->has('subject') && $request->subject != '') {
            $query->where('subject_id', $request->subject);
        }

        // Paginate results (9 per page)
        $getAllVideoLectures = $query->latest()->paginate(9);

        return view('studentPanel.recorded-classes', compact('getAllVideoLectures'));
    }
}
