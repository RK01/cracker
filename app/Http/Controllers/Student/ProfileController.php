<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Course_name;
use App\Models\User;
use App\Models\UserAcademic;
use App\Models\UserProfile;
use Illuminate\Auth\Events\Logout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function dashboard()
    {
        $userId = Auth::id();
        $profile = User::where('id', $userId)->with('profile', 'academic')->first() ?? new User();
        $data['profile'] = $profile ?? new User();
        return view('studentPanel.dashboard', $data);
    }

    public function profile()
    {
        $userId = Auth::id();
        $profile = User::where('id', $userId)->with('profile', 'academic')->first() ?? new User();
        $data['profile'] = $profile ?? new User(); 
        $data['course_name'] = Course::select('name', 'id')->get();
        $data['states'] = DB::table('states')->pluck('state_name', 'state_id');
        $data['cities'] = DB::table('cities')->select('city_id', 'city_name', 'state_id')->get()->groupBy('state_id');
        return view('studentPanel.profile', $data);
    }
    
    // Personal Info Save
    public function updatePersonal(Request $request) {
        $userId = Auth::id(); // Current login user id[cite: 5, 8]
        UserProfile::updateOrCreate(
            ['user_id' => $userId],
            $request->only(['dob', 'gender', 'blood_group', 'address', 'emergency_contact'])
        );
        return redirect()->back()->with('success', 'Personal info saved!');
    }

    // Academic Info Save
    public function updateAcademic(Request $request) {
        $userId = Auth::id();

        UserAcademic::updateOrCreate(
            ['user_id' => $userId],
            $request->only(['batch', 'school_name', 'class_year', 'board', 'target_year', 'math_score', 'physics_score', 'chemistry_score', 'biology_score', 'achievements', 'goals'])
        );
        return redirect()->back()->with('success', 'Academic info saved!');
    }

    // Password Update (Security)
    public function updatePassword(Request $request) {
        
        $request->validate([
            'current_password' => 'required|current_password',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user(); // Seedha user object lein
        $user->password = Hash::make($request->new_password);
        $user->save();
        Auth::logout();
        return redirect()->route('login')->with('success', 'Password updated successfully! Please log in again.');
    }
}