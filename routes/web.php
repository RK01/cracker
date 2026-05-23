<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\AssignmentInspectionController;
use App\Http\Controllers\admin\CourseDetailController;
use App\Http\Controllers\admin\CourseSubjectController;
use App\Http\Controllers\admin\dashboardController;
use App\Http\Controllers\admin\FacultyController;
use App\Http\Controllers\admin\StudentController;
use App\Http\Controllers\admin\StudyMaterialController as AdminStudyMaterialController;
use App\Http\Controllers\admin\TestInspectionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\faculty\AllocatedCourseController;
use App\Http\Controllers\faculty\AnnouncementsController;
use App\Http\Controllers\faculty\AssignmentController as FacultyAssignmentController;
use App\Http\Controllers\faculty\AttandanceController;
use App\Http\Controllers\faculty\manageAssignmentController;
use App\Http\Controllers\faculty\profileController as FacultyProfileController;
use App\Http\Controllers\faculty\TestController;
use App\Http\Controllers\faculty\DoubtsAndQueriesController as DoubtsResolveController;
use App\Http\Controllers\faculty\VideoLectureController;
use App\Http\Controllers\Student\AnnouncementController;
use App\Http\Controllers\Student\AssignmentController;
use App\Http\Controllers\Student\AttendanceController;
use App\Http\Controllers\Student\CertificateController;
use App\Http\Controllers\Student\EnrollmentController;
use App\Http\Controllers\Student\ProfileController;
use App\Http\Controllers\Student\StudyMaterialController;
use App\Http\Controllers\Student\CourseController;
use App\Http\Controllers\Student\OrderController;
use App\Http\Controllers\Student\DoubtsAndQueriesController;
use App\Http\Controllers\Student\TestController as StudentTestController;
use App\Http\Controllers\Student\VideoLectureController as StudentVideoLectureController;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Artisan;



/*|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which contains the "web" middleware group. Now create something great!           
*/

// Home Page
Route::get('/', function () {return view('index'); })->name('home');

Route::fallback(function () { return redirect('/'); });
// About Pages
Route::get('/about', function () { return view('about'); })->name('about');

Route::get('/vision-mission', function () { return view('vision-mission'); })->name('vision.mission');

// Course Pages (Category wise)
Route::prefix('courses')->group(function () {
    
    Route::get('/iit-jee', function () { return view('category-iit-jee'); })->name('courses.jee');

    Route::get('/neet', function () { return view('category-neet'); })->name('courses.neet');

    Route::get('/ca-foundation', function () { return view('course-ca-foundation'); })->name('courses.ca');

    Route::get('/clat', function () { return view('course-clat'); })->name('courses.clat');

    Route::get('/cuet', function () { return view('course-cuet'); })->name('courses.cuet');

    Route::get('/12th-dropper', function () { return view('course-12th-dropper'); })->name('courses.dropper');
});

// Other Pages
Route::get('/academic', function () { return view('academic'); })->name('academic');

Route::get('/olympiad', function () { return view('olympiad'); })->name('olympiad');

Route::get('/faculty', function () { return view('faculty'); })->name('faculty');

Route::get('/admissions', function () { return view('admissions'); })->name('admissions');

Route::get('/gallery', function () { return view('gallery'); })->name('gallery');

Route::get('/contact', function () { return view('contact'); })->name('contact');

Route::get('/get-sub-courses/{course_id}', function($course_id) {
    return DB::table('course_sub_category')->where('course_id', $course_id)->get();
});

Route::get('/get-subjects/{sub_course_id}', function($sub_course_id) {
    return DB::table('subjects')
        ->where('sub_course_id', $sub_course_id)
        ->distinct()
        ->get();
});

Route::get('/get-city/{sate_id}', function($sate_id) {
    return DB::table('cities')->where('state_id', $sate_id)->get();
});

// Auth Pages
Route::get('/login/{role?}', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Registration Routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
Route::get('/registration-success', function () {return view('registration-success');})->name('registration.success');
Route::get('/captcha/refresh', function () {
    $chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
    $captcha = substr(str_shuffle(str_repeat($chars, 6)), 0, 6);
    session(['captcha' => $captcha]);
    return response()->json(['captcha' => $captcha]);
})->name('captcha.refresh');

Route::get('/forgot-password', [RegisterController::class, 'showForgotPasswordForm'])->name('forgot-password');
Route::post('/forgot-password/check-email', [RegisterController::class, 'checkEmail'])->name('forgot-password.check-email');
Route::post('/forgot-password/update-password', [RegisterController::class, 'updatePassword'])->name('forgot-password.update-password');

/*
|--------------------------------------------------------------------------
| Student Dashboard Routes (New Files)
|--------------------------------------------------------------------------
| Ye routes aapke naye UI files (Study Materials, Live Classes, etc.) 
| ko handle karte hain.
*/

Route::middleware(['auth', 'role:student'])->prefix('student')->group(function () {

    // student Profile
    Route::get('/dashboard', [ProfileController::class, 'dashboard'])->name('student.dashboard');

    Route::get('/profile', [ProfileController::class, 'profile'])->name('student.profile');
    Route::post('/profile/personal', [ProfileController::class, 'updatePersonal'])->name('student.profile.personal.update');
    Route::post('/profile/academic', [ProfileController::class, 'updateAcademic'])->name('student.profile.academic.update');
    Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('student.profile.password.update');

    // User courses 
    Route::get('/courses', [CourseController::class, 'courses'])->name('student.courses');
    Route::get('/courses-details/{id}', [CourseController::class, 'courses_details'])->name('student.courses.details');
    Route::get('/course/payment/{id}', [CourseController::class, 'paymentPage'])->name('student.courses.payment');
    Route::post('/courses/buy/{id}', [CourseController::class, 'buy'])->name('student.courses.buy');
    

    // Certificates
    Route::get('/certificates', [CertificateController::class, 'index'])->name('student.certificates');
    Route::get('/certificate/download/{id}', [CertificateController::class, 'download'])->name('certificate.download');

    // User announcements
    Route::get('/announcements', [AnnouncementController::class, 'index'])->name('student.announcements');
    Route::post('/announcements/{id}/read', [AnnouncementController::class, 'markAsRead'])->name('announcements.read');

    // Assignments
    Route::get('/assignments', [AssignmentController::class, 'index'])->name('student.assignments');
    Route::post('/assignments/submit', [AssignmentController::class, 'submit'])->name('student.assignments.submit');

    // Attendance
    Route::get('/attendance', [AttendanceController::class, 'index'])->name('student.attendance');

    // Study Materials
    Route::get('/study-materials', [StudyMaterialController::class, 'index'])->name('student.materials');
    Route::get('/study-materials/download/{id}', [StudyMaterialController::class, 'download'])->name('materials.download');

    // Live Classes
    Route::get('/live-classes', function () { return view('studentPanel.live-classes');})->name('student.live');

    // Recorded Classes
    Route::get('/recorded-classes', [StudentVideoLectureController::class, 'index'])->name('student.recorded');

    // Exams & Tests
    Route::get('/exams', [StudentTestController::class, 'index'])->name('student.exams');
    Route::get('/student/tests/{id}/start', [StudentTestController::class, 'start'])->name('student.tests.show');
    Route::post('/student/tests/{id}/submit', [StudentTestController::class, 'submit'])->name('student.tests.submit');
    //kripa
    Route::get('/student/tests/{id}/result',[StudentTestController::class, 'result'])->name('student.tests.result');
    Route::get('/student/tests/{id}/download-pdf',[StudentTestController::class, 'downloadPdf'])->name('student.tests.pdf');

    // Doubts & Queries
    Route::get('/doubts-and-queries', [DoubtsAndQueriesController::class, 'index'])->name('student.doubts.and.queries');
    Route::post('/doubts-and-queries-store', [DoubtsAndQueriesController::class, 'store'])->name('student.doubts.store');

    // Enrollment & Course Selection
    Route::get('/enrollment', [EnrollmentController::class, 'index'])->name('student.enrollment');

    // My student.orders
    Route::get('/my-orders', [OrderController::class, 'myOrder'])->name('student.orders');


});

/*
|--------------------------------------------------------------------------
| Faculty Dashboard Routes (New Files)
|--------------------------------------------------------------------------
| Ye routes aapke naye UI files (Study Materials, Live Classes, etc.) 
| ko handle karte hain.
*/
Route::middleware(['auth', 'role:faculty'])->prefix('faculty')->name('faculty.')->group(function () {
    // Faculty dashboard routes
    Route::get('/dashboard', fn() => view('facultyPanel.faculty-dashboard'))->name('dashboard');

    // Faculty profile and management routes
    Route::get('/profile', [FacultyProfileController::class, 'index'])->name('profile');
    Route::post('/profile-update', [FacultyProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('/update-password', [FacultyProfileController::class, 'facultyUpdatePassword'])->name('update.password');

    // Faculty course management routes
    Route::get('/courses', [AllocatedCourseController::class, 'index'])->name('courses');


    // Faculty content management routes
    Route::get('/video-lectures', [VideoLectureController::class, 'index'])->name('video-lectures');
    Route::post('video-lectures-store', [VideoLectureController::class, 'store'])->name('video-lectures.store');
        
    Route::get('/video-lectures/{videoLecture}/edit', [VideoLectureController::class, 'edit'])->name('lectures.edit');
    // Route for handling the status toggle (Publish/Draft)
    // Note: This matches the pattern in your Blade: manageStatus/{id}/{status}
    Route::post('/video-lectures/{videoLecture}/status/{status}', [VideoLectureController::class, 'manageStatus'])->name('lectures.manageStatus');
    // Route for deleting the lecture
    Route::delete('/video-lectures/{videoLecture}', [VideoLectureController::class, 'destroy'])->name('lectures.destroy');



    // Faculty resource management routes
    Route::get('/resources-upload', [FacultyAssignmentController::class, 'resources_upload'])->name('resources');
    Route::post('/assignments/store', [FacultyAssignmentController::class, 'store_assignments'])->name('assignments.store');
    Route::post('/study-materials/store', [FacultyAssignmentController::class, 'store_study_materials'])->name('study-materials.store');

    // Faculty student interaction routes
    Route::get('/assignments', [manageAssignmentController::class, 'manage_assignment'])->name('assignments');
    Route::post('/assignment-review', [manageAssignmentController::class, 'assignment_review'])->name('assignment-review');


    // Test
    Route::get('/create-tests', [TestController::class, 'test_create'])->name('create-tests');
    Route::post('/tests/store', [TestController::class, 'store'])->name('tests.store'); 

    Route::get('/test/{id}', [TestController::class, 'show']);
    Route::post('/test/{id}/submit', [TestController::class, 'submit']);
    Route::get('/result/{attemptId}', [TestController::class, 'showResult'])->name('result');
    Route::get('/test-result', [TestController::class, 'testResult'])->name('test-result');

    Route::get('/view-result/{id}',[TestController::class,'viewResult'])->name('faculty.view.result');
    

    // Attendance routes 
    Route::get('/attendance', [AttandanceController::class, 'attendance'])->name('attendance');
    Route::post('attendance/store', [AttandanceController::class, 'storeAttendance'])->name('attendance.store');

    // Faculty analytics routes
    Route::get('/performance', fn() => view('facultyPanel.student-performance'))->name('performance');

    // Faculty support routes
    Route::get('/student-queries', [DoubtsResolveController::class, 'studentQueries'] )->name('student.queries');
    Route::post('/queries/reply/{id}', [DoubtsResolveController::class, 'replyStore'])->name('queries.reply');
    

    // Faculty announcements and live classes routes Announcements
    
    Route::get('announcements', [AnnouncementsController::class, 'announcements'])->name('announcements');
    Route::post('announcements-store', [AnnouncementsController::class, 'announcement_store'])->name('announcement.store');


    // Faculty live classes routes
    Route::get('/live-classes', fn() => view('facultyPanel.live-classes'))->name('live-classes');


});


// Admin Login
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::get('/admin/forgot-password', [AdminController::class, 'forgotPassword'])->name('admin.forgot.password');

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Route::get('get-sub-categories/{course_id}', [AdminStudyMaterialController::class, 'getSubCategories']);
    Route::get('/dashboard', [dashboardController::class, 'adminDashboard'])->name('dashboard');

    // Faculty
    Route::get('/add-faculty', [FacultyController::class, 'addFaculty'])->name('add.faculty');
    Route::post('/faculty/store', [FacultyController::class, 'facyltyStore'])->name('faculty.store');
    Route::get('/faculty-list', [FacultyController::class, 'facyltyList'])->name('faculty.list');

    
    // AJAX data fetch karne ke liye routing (Modal me load karne ke liye)
    Route::get('/faculty/{id}/edit', [FacultyController::class, 'edit'])->name('faculty.edit');
    Route::put('/faculty/{id}', [FacultyController::class, 'update_faculty'])->name('faculty.update');
    Route::delete('/faculty/{id}', [FacultyController::class, 'destroy'])->name('faculty.destroy');
    

    // Student
    Route::get('/student-list', [StudentController::class, 'studentList'])->name('student.list');
    Route::put('/student/{id}', [StudentController::class, 'update'])->name('student.update');
    Route::delete('/student/{id}', [StudentController::class, 'destroy'])->name('student.destroy');

    //Course Details
    Route::resource('course-details', CourseDetailController::class);

    // Subject
    Route::resource('subjects', CourseSubjectController::class);
    Route::get('get-sub-categories/{courseId}', [CourseSubjectController::class, 'getSubCategories'])->name('get.subcategories');

    // Study Material
    Route::get('study-materials/logs', [AdminStudyMaterialController::class, 'getDownloadLogs'])->name('study-materials.logs');
    Route::get('study-materials', [AdminStudyMaterialController::class, 'showActiveMaterialsDashboard'])->name('study-materials.active');

    // Assignment 
    Route::get('assignments/inspect', [AssignmentInspectionController::class, 'inspectAssignments'])->name('assignments.inspect');
         
    // Test 
    Route::get('test/inspect', [TestInspectionController::class, 'inspectTests'])->name('test.inspect');
    Route::get('test/inspect/{id}', [TestInspectionController::class, 'showDetails'])->name('tests.show-details');



});