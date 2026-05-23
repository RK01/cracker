<?php

namespace App\Http\Controllers\faculty;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Submission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class manageAssignmentController extends Controller
{
    public function manage_assignment()
    {
        // return Auth::user();
        $userId = auth()->id();
        $courseId = auth()->user()->course_id;
        $today = now()->toDateString();

        // $allAssignments = Assignment::with('student')->where('course_id', $courseId)
        //     ->where('posted_by', $userId)
        //     ->where('due_date', '>=', now()->toDateString())
        //     ->latest()->get();

        $query = Assignment::with('student')
            ->where('course_id', $courseId)
            ->where('posted_by', $userId);

        if (request('search')) {
            $query->where('title', 'like', '%' . request('search') . '%');
        }

        if (request('type')) {
            $query->where('type', request('type'));
        }

        if (request('status') == 'active') {
            $query->whereDate('due_date', '>=', now());
        }

        if (request('status') == 'expired') {
            $query->whereDate('due_date', '<', now());
        }

        $allAssignments = $query->latest()->get();

        $getStudent = User::with('submissions')->where('course_id', $courseId)->where('role', 'student')->get();
        $data = [
            'assignments' => $allAssignments, // Pass all to the view, filter in Blade or keep as is
            'getAllStudents' => $getStudent,
            'stats' => [
                'total'   => (clone $allAssignments)->count(),
                'active'  => (clone $allAssignments)->where('due_date', '>=', $today)->count(),
                'expired' => (clone $allAssignments)->where('due_date', '<', $today)->count(),
                'notes'   => (clone $allAssignments)->where('type', 'notes')->count(),
            ]
        ];
        return view('facultyPanel.manage-assignments', $data);
    }

    public function manage_assignment_bkp()
    {
        $userId = auth()->id();
        $courseId = auth()->user()->course_id;
        $today = now()->toDateString();

        // Fetch all assignments for this faculty/course (including expired for stats)
        $allAssignments = Assignment::with('student')
            ->where('course_id', $courseId)
            ->where('posted_by', $userId)
            ->orderBy('due_date', 'desc')
            ->get();
        $getStudent = User::where('course_id', $courseId)->get();

        $data = [
            'assignments' => $allAssignments,
            'getAllStudents' => $getStudent,
            'stats' => [
                'total'   => $allAssignments->count(),
                'active'  => $allAssignments->where('due_date', '>=', $today)->count(),
                'expired' => $allAssignments->where('due_date', '<', $today)->count(),
                'notes'   => $allAssignments->where('type', 'notes')->count(),
            ]
        ];

        return view('facultyPanel.manage-assignments', $data);
    }



    public function assignment_review(Request $request)
    {
        // 1. Input Validation
        $validated = $request->validate([
            'submission_id'       => 'required|exists:submissions,id',
            'score_by_faculty'    => 'required|numeric|min:0|max:100',
            'status'              => 'required|in:accepted,rejected',
            'comments_by_faculty' => 'required|string|max:1000',
        ]);

        try {
            // 2. Data Update
            $submission = Submission::findOrFail($request->submission_id);
            $status = '';
            if ($request->status === 'accepted') {
                $status = 'completed';
            }
            $submission->update([
                'score_by_faculty'    => $request->score_by_faculty,
                'status'              => $status,
                'comments_by_faculty' => $request->comments_by_faculty,
                'completed_at_faculty' => now(), // Current timestamp
            ]);

            // 3. Success Response
            return redirect()->back()->with('success', 'Assignment review submitted successfully!');
        } catch (\Exception $e) {
            // 4. Error Handling
            return redirect()->back()
                ->with('error', 'Something went wrong while updating: ' . $e->getMessage())
                ->withInput();
        }
    }
}
