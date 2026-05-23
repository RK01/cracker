<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CertificateController extends Controller
{
    public function index(Request $request) {
    $user = auth()->user();
    $query = $user->certificates();

    // 1. Filtering Logic
    if ($request->has('type') && $request->type != 'all') {
        $query->where('type', $request->type);
    }
    if ($request->has('year') && $request->year != 'all') {
        $query->where('issue_year', $request->year);
    }
    if ($request->has('search')) {
        $query->where('title', 'like', '%' . $request->search . '%');
    }

    $certificates = $query->latest()->paginate(9)->withQueryString();

    // 2. Stats Calculation
    $stats = [
        'total' => $certificates->count(),
        'excellence' => $certificates->where('type', 'achievement')->count(),
        'course' => $certificates->where('type', 'course')->count(),
        'competition' => $certificates->where('type', 'competition')->count(),
    ];

    return view('studentPanel.certificates', compact('certificates', 'stats'));
}

public function download($id) {
    $certificate = Certificate::findOrFail($id);
    
    // Check karein file exist karti hai ya nahi
    if (Storage::disk('public')->exists($certificate->file_path)) {
        return Storage::disk('public')->download($certificate->file_path);
    }

    return abort(404, 'File not found on server');
}
}
