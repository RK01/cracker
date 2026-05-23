<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }
    
    public function showFacultyLoginForm(){
        return view('faculty-login');
    }

    public function login(Request $request)
    {
        // 1. Basic Validation (Email/Username and Password)
        $credentials = $request->validate([
            'login'    => 'required|string',
            'password' => 'required|string',
        ]);

        // 2. Identify Field Type (Email or Username)
        $fieldType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // 3. Attempt Authentication (Single Entry Point)
        if (Auth::attempt([$fieldType => $request->login, 'password' => $request->password], $request->remember)) {

            $user = Auth::user();

            // --- ROLE BOUNDARY VALIDATION ---

            // Case A: if is Request Admin Login 
            if ($request->role === 'admin_login') {
                if ($user->role !== 'admin') {
                    return $this->logoutWithError($request, 'Access denied. This panel is restricted to administrators only.');
                }

                $request->session()->regenerate();
                return redirect()->intended(route('admin.dashboard'));
            }

            // Case B: if is Student/Faculty Login Request
            if ($request->role === 'student_login') {

                if ($user->role === 'student') {
                    $request->session()->regenerate();
                    return redirect()->intended(route('student.profile'));
                }

                if ($user->role === 'faculty') {
                   return $this->logoutWithError($request, 'Faculty must use the dedicated faculty login portal.');
                }

                // Agar admin is form se login karne ki koshish kare
                if ($user->role === 'admin') {
                    return $this->logoutWithError($request, 'Administrators must use the dedicated admin login portal.');
                }
            }
            
            // Case C: if is Faculty Login Request
            if ($request->role === 'faculty_login') {
                
                if ($user->role === 'faculty') {
                    $request->session()->regenerate();
                    return redirect()->intended(route('faculty.dashboard'));
                }

                if ($user->role === 'student') {
                    return $this->logoutWithError($request, 'Student must use the dedicated student login portal.');
                }


                // Agar admin is form se login karne ki koshish kare
                if ($user->role === 'admin') {
                    return $this->logoutWithError($request, 'Administrators must use the dedicated admin login portal.');
                }
            }

            // Fallback: Agar Auth pass but request role undefined,  its unmapped
            return $this->logoutWithError($request, 'Invalid request context or unauthorized role.');
        }

        // 4. Verification Failed (Wrong email/username or password)
        return back()->withErrors([
            'login' => 'The provided credentials do not match our records.',
        ])->onlyInput('login');
    }

    /**
     * Helper function to cleanly log out unauthorized user and clear session data
     */
    private function logoutWithError(Request $request, $message)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return back()->withErrors([
            'login' => $message,
        ])->onlyInput('login');
    }

   

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
