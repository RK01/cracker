<?php

namespace App\Http\Controllers\faculty;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;

class AttandanceController extends Controller
{
    public function attendance(Request $request)
    {
        $selectedDate = $request->date ?? now()->toDateString();
        $subject = $request->subject ?? 'Math';
        $course_id = auth()->user()->course_id;

        /*
        |--------------------------------------------------------------------------
        | Students (course wise)
        |--------------------------------------------------------------------------
        */
        $students = User::where('role', 'student')
            ->where('course_id', $course_id)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Attendance for selected date + subject
        |--------------------------------------------------------------------------
        */
        $todayAttendance = Attendance::whereDate('date', $selectedDate)
            ->where('subject', $subject)
            ->whereHas('user', function ($q) use ($course_id) {
                $q->where('course_id', $course_id);
            })
            ->get()
            ->keyBy('user_id');

        /*
        |--------------------------------------------------------------------------
        | All Attendance (course wise)
        |--------------------------------------------------------------------------
        */
        $allAttendance = Attendance::with('user')
            ->whereHas('user', function ($q) use ($course_id) {
                $q->where('course_id', $course_id);
            })
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Stats (course wise students)
        |--------------------------------------------------------------------------
        */
        $totalStudents = $students->count();

        $presentCount = $todayAttendance->where('status', 'present')->count();
        $absentCount = $todayAttendance->where('status', 'absent')->count();

        $totalMarked = $todayAttendance->whereIn('status', ['present', 'absent'])->count();

        $attendancePercentage = $totalMarked > 0
            ? round(($presentCount / $totalMarked) * 100, 1)
            : 0;

        /*
        |--------------------------------------------------------------------------
        | Monthly / Report Data
        |--------------------------------------------------------------------------
        */
        $reportData = $allAttendance->groupBy('user_id')->map(function ($records) {

            $user = $records->first()->user;

            $totalClasses = $records->whereIn('status', ['present', 'absent'])->count();
            $present = $records->where('status', 'present')->count();
            $absent = $records->where('status', 'absent')->count();

            $percentage = $totalClasses > 0
                ? round(($present / $totalClasses) * 100, 2)
                : 0;

            if ($percentage >= 90) {
                $status = 'Good';
                $badge = 'success';
            } elseif ($percentage >= 75) {
                $status = 'Satisfactory';
                $badge = 'primary';
            } elseif ($percentage >= 60) {
                $status = 'Average';
                $badge = 'warning';
            } else {
                $status = 'Poor';
                $badge = 'danger';
            }

            return [
                'student_name' => $user?->name ?? 'N/A',
                'total_classes' => $totalClasses,
                'present' => $present,
                'absent' => $absent,
                'percentage' => $percentage,
                'status' => $status,
                'badge' => $badge,
            ];
        });

        return view('facultyPanel.attendance-management', compact(
            'students',
            'todayAttendance',
            'selectedDate',
            'subject',
            'totalStudents',
            'presentCount',
            'absentCount',
            'attendancePercentage',
            'reportData'
        ));
    }

    public function storeAttendance(Request $request)
{
    $request->validate([
        'date' => 'required',
        'subject' => 'required',
        'status' => 'required|array',
    ]);

    foreach ($request->status as $userId => $status) {

        if ($status == '') {
            continue;
        }

        Attendance::updateOrCreate(
            [
                'user_id' => $userId,
                'date' => $request->date,
                'subject' => $request->subject,
            ],
            [
                'status' => $status,
            ]
        );
    }

    return back()->with('success', 'Attendance saved successfully');
}
}