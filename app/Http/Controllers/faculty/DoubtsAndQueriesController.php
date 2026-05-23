<?php

namespace App\Http\Controllers\faculty;

use App\Http\Controllers\Controller;
use App\Models\DoubtsAndQuery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoubtsAndQueriesController extends Controller
{
    public function studentQueries()
    {
        $queries = DoubtsAndQuery::where('course_id', Auth::user()->course_id)->get();
        $stats = [
            'total' => $queries->count(),
            'pending' => $queries->where('status', 'open')->count(),
            'resolved' => $queries->where('status', 'resolved')->count(),
        ];
        return view('facultyPanel.student-queries', compact('queries', 'stats'));
    }

    public function replyStore(Request $request, $id)
    {
        $request->validate(['response' => 'required|string']);

        $query = DoubtsAndQuery::findOrFail($id);

        $path = null;
        $fileSize = null;
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            
            $fileSize = $file->getSize();
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/doubtsAndQuery'), $fileName);
            $path = 'doubtsAndQuery/' . $fileName;
        }
        
        $query->update([
            'status' => 'resolved',
            'faculty_reply' => $request->response,
            'faculty_attachment' => $path,
            'updated_at'=> now(),
        ]);

        return back()->with('success', 'Response sent successfully!');
    }
}
