<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Submission;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignmentController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $now = now();

        // 1. All Assignments IDs submitted by user
        $submittedIds = $user->submissions()->pluck('assignment_id')->toArray();
        $purchasesids = $user->purchases()->pluck('course_sub_category_id')->toArray();
        

        // 2. Pending: Not submitted & Not expired
        $pending = Assignment::where('course_id', $user->course_id)->whereIn('sub_cat_course_id', $purchasesids)->where('due_date', '>', $now)->whereNotIn('id', $submittedIds) ->orderBy('due_date', 'asc')->paginate(10);
        
        // 3. Submitted: In submissions table but not graded
        $submitted = $user->submissions()->where('status', 'submitted')->with('assignment')->latest()->paginate(10);

        // 4. Completed: 
        $completed = $user->submissions()->where('status', 'completed')->with('assignment')->latest()->paginate(10);

        // Stats
        $stats = [
            'completed_count' => $completed->count(),
            'pending_count' => $pending->count(),
            'submitted_count' => $submitted->count(),
            'avg_score' => $completed->avg('score') ?? 0,
            'due_today' => $pending->whereBetween('due_date', [$now->startOfDay(), $now->endOfDay()])->count()
        ];

        return view('studentPanel.assignments', compact('pending', 'submitted', 'completed', 'stats'));
    }

    public function submit(Request $request) 
    {
        // 1. Validation
        $request->validate([
            'assignment_id' => 'required|exists:assignments,id',
            'file' => 'required|file|mimes:pdf,doc,docx,jpg,png|max:10240',
            'comments_by_user' => 'nullable|string|max:500',
        ]);

        try {
            $user = auth()->user();
            
            // 2. Check if already submitted
            $alreadySubmitted = Submission::where('user_id', $user->id)
                                ->where('assignment_id', $request->assignment_id)
                                ->exists();

            if ($alreadySubmitted) {
                return back()->with('error', 'You have already submitted this assignment!');
            }

            // 3. File Handling
            if ($request->hasFile('file')) {
                $file = $request->file('file');               
                $filename = 'sub_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('storage/assignment'), $filename);
                $path = 'assignment/' . $filename;

                // 4. Database Entry
                Submission::create([
                    'assignment_id' => $request->assignment_id,
                    'user_id' => $user->id,
                    'file_path' => $path,
                    'comments_by_user' => $request->comments_by_user,
                    'submitted_at_user' => now(),
                    'status' => 'submitted',
                ]);

                return back()->with('success', 'Assignment submitted successfully!');
            }

        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong!');
            
        }
    }
}
