<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{

    public function showRegistrationForm()
    {
        $chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
        $captcha = substr(str_shuffle(str_repeat($chars, 6)), 0, 6);
        $courses = Course::select('name', 'id')->get();
        $states = DB::table('states')->pluck('state_name', 'state_id');
        $cities = DB::table('cities')
            ->select('city_id', 'city_name', 'state_id')
            ->get()
            ->groupBy('state_id');
        session(['captcha' => $captcha]);
        return view('register', compact('captcha', 'courses', 'states', 'cities'));
    }

    public function store(Request $request)
    {

        // 1. Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|digits:10',
            'email' => 'required|email|unique:users,email',
            'course_id' => 'required',
            'state' => 'required',
            'city' => 'required',
            'captcha' => 'required' // Isse session captcha se match karein
        ]);

        if (strtoupper($request->captcha) !== session('captcha')) {
            return back()
                ->withErrors(['captcha' => 'Invalid CAPTCHA! Please try again.'])
                ->withInput();
        }

        session()->forget('captcha');

        // 2. Username aur Password Generate karna
        $username = Str::slug(explode(' ', $request->name)[0]) . rand(1000, 9999);
        $plainPassword = Str::random(8);

        // 3. User Create karna
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'course_id' => $request->course_id,
            'state' => $request->state,
            'city' => $request->city,
            'username' => $username,
            'password' => $plainPassword,
        ]);

        // 4. Success Page par redirect karna details ke saath
        return redirect()->route('registration.success')->with([
            'name' => $user->name,
            'email' => $user->email,
            'username' => $user->username,
            'password' => $plainPassword,
        ]);
    }

    /**
     * Forgot Password
     */

    public function showForgotPasswordForm()
    {
        return view('forgot-password');
    }
    
    public function checkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
        $user = User::where('email', $request->email)->first();
        if ($user) {
            return response()->json(['status' => 'success', 'message' => 'Email found. Please enter your new password.']);
        }
        return response()->json(['status' => 'error', 'message' => 'Email not registered.']);
    }


    public function updatePassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $user = User::where('email', $request->email)->first();
        if ($user) {
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect()->route('login')->with('success', 'Password updated successfully.');
        }
        return redirect()->back()->with('error', 'Failed to update password.');
    }
}
