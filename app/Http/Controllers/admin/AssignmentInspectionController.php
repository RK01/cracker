<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class AssignmentInspectionController extends Controller
{
    public function inspectAssignments(Request $request)
    {
        $today = now()->toDateString();
        $courses = Course::get() ?? new Course();
        // 1. Initializing Query with Nested Relations (Eager Loading to prevent N+1 issues)
        $query = Assignment::with(['student']); // 'uploader' assuming belongsTo relationship with User model (posted_by)

        // 2. Multi-Tenant Global Filters
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->status === 'active') {
            $query->whereDate('due_date', '>=', now());
        } elseif ($request->status === 'expired') {
            $query->whereDate('due_date', '<', now());
        }

        // Fetching Master Immutable Dataset
        $allAssignments = $query->latest()->get();

        // 3. Global Structural Student Footprints
        $getStudent = User::with(['submissions' => function($q) {
            $q->latest();
        }])->where('role', 'student')->get();

        // 4. Metric Aggregation Matrix
        $data = [
            'assignments' => $allAssignments,
            'getAllStudents' => $getStudent,
            'courses'=> $courses,
            'stats' => [
                'total'   => $allAssignments->count(),
                'active'  => $allAssignments->where('due_date', '>=', $today)->count(),
                'expired' => $allAssignments->where('due_date', '<', $today)->count(),
                'notes'   => $allAssignments->where('type', 'notes')->count(),
            ]
        ];

        return view('adminPanel.assignments.assignments-inspection', $data);
    }
}
