<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $attendanceData = Attendance::where('user_id', $user->id)
            ->orderBy('date', 'desc')
            ->get();

        // 1. Overall Stats
        $totalClasses = $attendanceData->where('status', '!=', 'holiday')->count();
        $presentCount = $attendanceData->where('status', 'present')->count();
        $absentCount = $attendanceData->where('status', 'absent')->count();
        $overallPercentage = $totalClasses > 0 ? round(($presentCount / $totalClasses) * 100) : 0;

        // 2. Subject-wise Grouping
        $subjectWise = $attendanceData->groupBy('subject')->map(function ($items) {
            $total = $items->where('status', '!=', 'holiday')->count();
            $present = $items->where('status', 'present')->count();
            return [
                'total' => $total,
                'present' => $present,
                'absent' => $items->where('status', 'absent')->count(),
                'percentage' => $total > 0 ? round(($present / $total) * 100, 1) : 0
            ];
        });

        // 3. Monthly Overview (For Chart)
        $monthlyData = $attendanceData->where('status', '!=', 'holiday')
            ->groupBy(function ($d) {
                return \Carbon\Carbon::parse($d->date)->format('M');
            })->map(function ($month) {
                return round(($month->where('status', 'present')->count() / $month->count()) * 100);
            });

            // Controller mein
            $recentAttendance = Attendance::where('user_id', auth()->id())
                                ->whereMonth('date', now()->month)
                                ->whereYear('date', now()->year)
                                ->get()
                                ->keyBy('date'); 

          
            $thisMonthPresent = $recentAttendance->where('status', 'present')->count();
            $thisMonthAbsent = $recentAttendance->where('status', 'absent')->count();
            $thisMonthHolidays = $recentAttendance->where('status', 'holiday')->count();

        return view('studentPanel.attendance', compact('overallPercentage', 'totalClasses', 'presentCount', 'absentCount', 'subjectWise', 'monthlyData', 'recentAttendance', 'thisMonthPresent', 'thisMonthAbsent', 'thisMonthHolidays' ));
        
    }
}
