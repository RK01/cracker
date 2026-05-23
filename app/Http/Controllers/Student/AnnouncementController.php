<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index(Request $request) {
        $user = auth()->user();
        
        // Stats Calculation
        $stats = [
            'total' => Announcement::count(),
            'important' => Announcement::where('priority', 'high')->count(),
            'this_week' => Announcement::where('created_at', '>=', now()->startOfWeek())->count(),
            'read' => $user->readAnnouncements()->count() // Relationship required in User model
        ];

        // Query with Filters
        $query = Announcement::query();

        if ($request->category && $request->category != 'all') {
            $query->where('category', $request->category);
        }

        if ($request->priority && $request->priority != 'all') {
            $query->where('priority', $request->priority);
        }

        $announcements = $query->latest()->paginate(10);

        return view('studentPanel.announcements', compact('stats', 'announcements'));
    }

    public function markAsRead($id) {
        $user = auth()->user();
        
        // Check agar pehle se read nahi kiya hai toh attach karein
        if (!$user->readAnnouncements()->where('announcement_id', $id)->exists()) {
            $user->readAnnouncements()->attach($id);
        }

        return response()->json(['success' => true, 'message' => 'Marked as read']);
    }
}
