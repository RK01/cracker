<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Announcement;
use App\Models\Course;
use App\Models\CourseSubCategory;
use App\Models\FacultyDetail;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Sabberworm\CSS\Rule\Rule;

class FacultyController extends Controller
{
    public function addFaculty()
    {
        $data['courses'] = Course::get() ?? new Course();
        $data['subjects'] = Subject::get();
        $data['courseSubCategory'] = CourseSubCategory::get();
        $data['states'] = DB::table('states')->get();
        return view('adminPanel.add-faculty', $data);
    }


    public function facyltyStore(Request $request)
    {
        // 1. Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|digits:10|unique:users,phone',
            'role' => 'required|in:student,faculty',
            'course_id' => 'required|exists:courses,id',
            'sub_cat_course_id' => 'required|array', // Multiple IDs
            'subject_id' => 'required|exists:subjects,id',
            'state_id' => 'required',
            'city_id' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        // 2. Transaction Start
        DB::beginTransaction();

        try {
            // Create Main User
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'role' => $request->role,
                'course_id' => $request->course_id,
                'state' => $request->state_id,
                'city' => $request->city_id,
                'username' => explode('@', $request->email)[0],
                'password' => Hash::make($request->password),
            ]);
            FacultyDetail::create([
                'user_id' => $user->id,
                'course_id' => $request->course_id,
                'sub_course_ids' => $request->sub_cat_course_id,
                'subject_id' => $request->subject_id,
                'state' => $request->state_id,
                'city' => $request->city_id,
                'qualification' => $request->qualification ?? ' ',
                'years_of_experience' => $request->years_of_experience ?? ' ',
                'bio' => $request->bio ?? ' ',
            ]);

            DB::commit();

            return back()->with('success', 'Faculty Registered Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error occurred: ' . $e->getMessage())->withInput();
        }
    }

    public function facyltyList(){
        $data['courses'] = Course::get() ?? new Course();
        $data['subjects'] = Subject::get();
        $data['courseSubCategory'] = CourseSubCategory::get();
        $data['states'] = DB::table('states')->get();
        $data['facultyLists'] = User::with('facultyDetail')->where('role', 'faculty')->orderBy('id', 'desc')->get() ?? new User();
        return view('adminPanel.total-faculty', $data);
    }

    public function update_faculty(Request $request, $id)
    {
        // 1. Strict Server Side Validation
        $request->validate([
            'name'                => 'required|string|max:255',
            'email'               => 'required|email|unique:users,email,' . $id,
            'phone'               => 'required|digits:10|unique:users,phone,' . $id,
            'username'            => 'required|string|unique:users,username,' . $id,
            'course_id'           => 'required',
            'sub_cat_course_id'   => 'required|array',
            'subject_id'          => 'required',
            'qualification'       => 'nullable|string',
            'years_of_experience' => 'nullable|string',
            'bio'                 => 'nullable|string',
            'password'            => 'nullable|string|min:6|confirmed',
        ]);

        // 2. Base User Update
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->username = $request->username;
        $user->course_id = $request->course_id;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        // 3. Faculty Relation Detail Handling (Null Proofing)
        // Data me agar detail table pehle se empty/null ho to `updateOrCreate` loop use karein
        FacultyDetail::updateOrCreate(
            ['user_id' => $user->id],
            [
                'course_id'          => $request->course_id,
                'sub_course_ids'     => $request->sub_cat_course_id, // Ensure model handles array to JSON casting
                'subject_id'         => $request->subject_id,
                'qualification'      => $request->qualification,
                'years_of_experience'=> $request->years_of_experience,
                'bio'                => $request->bio,
                'state'              => $user->state, // fallback syncing
                'city'               => $user->city,
            ]
        );

        return redirect()->back()->with('success', 'Faculty profile information updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        // Cascading deletion check
        if($user->facultyDetail) {
            $user->facultyDetail->delete();
        }
        $user->delete();

        return redirect()->back()->with('success', 'Faculty member removed successfully.');
    }
}
