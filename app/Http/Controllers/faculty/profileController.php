<?php

namespace App\Http\Controllers\faculty;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class profileController extends Controller
{
    public function index()
    {
        $user = User::with('facultyDetail')->where('id', auth()->id())->first() ?? new User;
        $subjects = Subject::where('course_id', Auth::user()->course_id)->get() ?? new Subject;
        return view('facultyPanel.faculty-profile', compact('user', 'subjects'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'name'          => 'required|string|max:255',
            'qualification' => 'required|string|max:255',
            'experience'    => 'required|numeric|min:0',
            'bio'           => 'required|string|min:10',
        ]);

        // 2. Transaction Start
        DB::beginTransaction();

        try {
            $user->update([
                'name' => $request->name,
            ]);

            $user->facultyDetail()->updateOrCreate(
                ['user_id' => $user->id],
                [
                    'qualification'       => $request->qualification,
                    'years_of_experience' => $request->experience,
                    'bio'                 => $request->bio,
                ]
            );

            DB::commit();
            return back()->with('success', 'Profile updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong: ' . $e->getMessage())->withInput();
        }
    }

    public function facultyUpdatePassword(Request $request)
    {
        // 1. Validation
        $request->validate([
            'current_password' => 'required',
            'new_password'     => ['required', 'confirmed', Password::min(8)],
        ]);

        $user = auth()->user();

        // 2. Check agar Current Password match hota hai
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Aapka purana password galat hai!');
        }

        // 3. Password Update karein
        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with('success', 'Password successfully change ho gaya hai!');
    }
}
