<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\StudyMaterial;
use App\Models\DownloadLog;
use Illuminate\Http\Request;

class StudyMaterialController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $purchasesids = $user->purchases()->pluck('course_sub_category_id')->toArray();


        $query = StudyMaterial::query();

        // Search filter
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Subject filter
        if ($request->filled('subject')) {
            $query->where('subject', $request->subject);
        }

        // Type filter
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Class filter
        if ($request->filled('class')) {
            $query->where('target_class', $request->class);
        }

        $materials = $query->whereIn('sub_cat_course_id',$purchasesids)->where('course_id', auth()->user()->course_id)->latest()->get();

        if ($request->ajax()) {
            return view('studentPanel.partials.materials_grid', compact('materials'))->render();
        }

        // Normal page load ke liye
        $stats = [
            'pdf' => StudyMaterial::where('type', 'pdf')->count(),
            'ppt' => StudyMaterial::where('type', 'ppt')->count(),
            'notes' => StudyMaterial::where('type', 'notes')->count(),
            'worksheet' => StudyMaterial::where('type', 'worksheet')->count(),
        ];
        $recentDownloads = DownloadLog::with('material')->where('user_id', auth()->id())->latest()->take(10)->get();

        return view('studentPanel.study-materials', compact('materials', 'stats', 'recentDownloads'));
    }

    public function download($id)
    {
        $material = StudyMaterial::findOrFail($id);

        // Log entry
        DownloadLog::create([
            'user_id' => auth()->id(),
            'study_material_id' => $id, // Column name check karein
            'downloaded_at' => now()
        ]);

        $path = storage_path("app/public/{$material->file_path}");

        if (!file_exists($path)) {
            return abort(404, 'File not found');
        }

        return response()->download($path);
    }
}
