<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\DownloadLog;
use App\Models\StudyMaterial;
use Illuminate\Http\Request;
use App\Http\Controllers\admin\Carbon;
use Carbon\Carbon as CarbonAlias;

class StudyMaterialController extends Controller
{
    public function getDownloadLogs(Request $request)
    {
        // Realtime search string trigger handler
        $search = $request->input('search');

        // Query builder optimization initializing with relations (Eager Loading)
        $query = DownloadLog::with(['material', 'user']);

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                // Check logs inside users relational table fields
                $q->whereHas('user', function ($userQuery) use ($search) {
                    $userQuery->where('name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%');
                })
                    // Check logs via target structural materials parameters
                    ->orWhereHas('material', function ($materialQuery) use ($search) {
                        $materialQuery->where('title', 'like', '%' . $search . '%')
                            ->orWhere('course_id', 'like', '%' . $search . '%')
                            ->orWhere('type', 'like', '%' . $search . '%');
                    });
            });
        }

        // Dynamic Pagination pipeline construction
        $logs = $query->orderBy('id', 'desc')->paginate(15);

        // Dynamic Metrics Blocks Generation
        $activeMaterialsCount = StudyMaterial::count();
        $todayDownloadsCount  = DownloadLog::whereDate('downloaded_at', CarbonAlias::today())->count();

        return view('adminPanel.study-materials.logs', compact(
            'logs',
            'activeMaterialsCount',
            'todayDownloadsCount'
        ));
    }

    public function showActiveMaterialsDashboard()
    {
        // Eager loading structural relations + nested download logs along with specific user profiles
        $activeMaterials = StudyMaterial::with([
            'uploader',                             // Kisne material generate kiya uski profiles
            'course',                               // Master Course relational metadata
            'subCategory',                          // Sub Category relational metadata
            'downloadLogs' => function ($query) {
                $query->orderBy('downloaded_at', 'desc'); // New downloads timeline on top
            },
            'downloadLogs.user'                     // Sub-loop student info who pulled the trigger
        ])
            ->orderBy('id', 'desc')
            ->paginate(10); // Standard layout pagination constraint

        return view('adminPanel.study-materials.all-study-material', compact('activeMaterials'));
    }
}
