<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseSubCategory;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function studentList(Request $request)
    {
        $data['courses'] = Course::get() ?? new Course();
        $data['subjects'] = Subject::get();
        $data['courseSubCategory'] = CourseSubCategory::get();
        $data['states'] = DB::table('states')->get();

        // 1. Base query setup initialization
        $query = User::with('profile')->where('role', 'student');

        // 2. Real-time Text Searching Pipeline (Name, Email, Phone, Username)
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('phone', 'LIKE', "%{$search}%")
                    ->orWhere('username', 'LIKE', "%{$search}%");
            });
        }

        // 3. Dropdown Course Stream Filtering Pipeline
        if ($request->filled('course_id')) {
            $query->where('course_id', $request->input('course_id'));
        }

        // 4. Generate dynamic pagination with current system query sorting state
        $data['studentLists'] = $query->orderBy('id', 'desc')->paginate(5);

        return view('adminPanel.total-student', $data);
    }

    /**
     * Update candidate parameters and child relation attributes safely
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Form inputs evaluation framework
        $request->validate([
            'name'              => 'required|string|max:255',
            'email'             => 'required|email|unique:users,email,' . $user->id,
            'phone'             => 'required|string|max:10',
            'username'          => 'required|string|unique:users,username,' . $user->id,
            'course_id'         => 'required',
            'blood_group'       => 'nullable|string|max:5',
            'emergency_contact' => 'nullable|string|max:10',
            'gender'            => 'nullable|string',
            'address'           => 'nullable|string',
            'password'          => 'nullable|string|min:6|confirmed'
        ]);

        DB::beginTransaction();
        try {
            // 1. Update Core User Details
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->username = $request->username;
            $user->course_id = $request->course_id;

            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }
            $user->save();

            // 2. Safe updates on related structural profile profile table
            $user->profile()->updateOrCreate(
                ['user_id' => $user->id],
                [
                    'blood_group'       => $request->blood_group,
                    'emergency_contact' => $request->emergency_contact,
                    'gender'            => $request->gender,
                    'address'           => $request->address
                ]
            );

            DB::commit();
            return redirect()->back()->with('success', 'Candidate core matrix synchronized successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Operational compilation failure: ' . $e->getMessage());
        }
    }

    /**
     * Purge operational candidate and its child records from system space
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        DB::beginTransaction();
        try {
            // Child relations deleted cascade tracking avoids broken database indexes
            if ($user->profile) {
                $user->profile()->delete();
            }
            $user->delete();

            DB::commit();
            return redirect()->back()->with('success', 'Candidate records completely purged from memory.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Purge abort execution fault: ' . $e->getMessage());
        }
    }
}
