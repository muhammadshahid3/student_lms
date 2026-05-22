<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\StudentController as AdminStudentController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\MarkController;
use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\AssignmentController;
use App\Http\Controllers\Admin\NoticeController;
use App\Http\Controllers\Admin\FeeController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Student\ProfileController;
use App\Http\Controllers\Student\CourseController as StudentCourseController;
use App\Http\Controllers\Student\MarkController as StudentMarkController;
use App\Http\Controllers\Student\AttendanceController as StudentAttendanceController;
use App\Http\Controllers\Student\AssignmentController as StudentAssignmentController;
use App\Http\Controllers\Student\NoticeController as StudentNoticeController;
use App\Http\Controllers\Student\FeeController as StudentFeeController;

Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::get('/admin-login', [AuthController::class, 'showAdminLoginForm'])->name('admin.login')->middleware('guest');
Route::get('/student-register', [AuthController::class, 'showStudentRegisterForm'])->name('student.register')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::post('/admin-login', [AuthController::class, 'adminLogin'])->name('admin.login.post')->middleware('guest');
Route::post('/student-register', [AuthController::class, 'studentRegister'])->name('student.register.post')->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Student Management
    Route::resource('students', AdminStudentController::class);
    Route::post('/students/{student}/approve', [AdminStudentController::class, 'approve'])->name('students.approve');
    Route::post('/students/{student}/block', [AdminStudentController::class, 'block'])->name('students.block');
    Route::post('/students/{student}/unblock', [AdminStudentController::class, 'unblock'])->name('students.unblock');

    // Category Management
    Route::resource('categories', CategoryController::class);

    // Course Management
    Route::resource('courses', CourseController::class);

    // Marks Management
    Route::resource('marks', MarkController::class);

    // Attendance Management
    Route::resource('attendance', AttendanceController::class);
    Route::post('/attendance/get-students-by-class', [AttendanceController::class, 'getStudentsByClass'])->name('attendance.getStudentsByClass');

    // Assignment Management
    Route::resource('assignments', AssignmentController::class);

    // Notice Management
    Route::resource('notices', NoticeController::class);

    // Fee Management
    Route::resource('fees', FeeController::class);
    Route::post('/fees/{fee}/mark-paid', [FeeController::class, 'markAsPaid'])->name('fees.mark-paid');
});

// Student Routes
Route::middleware(['auth', 'student', 'student_approved'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('dashboard');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Course Routes
    Route::resource('courses', StudentCourseController::class)->only(['index', 'show']);

    // Mark Routes
    Route::resource('marks', StudentMarkController::class)->only(['index', 'show']);

    // Attendance Routes
    Route::resource('attendance', StudentAttendanceController::class)->only(['index']);

    // Assignment Routes
    Route::resource('assignments', StudentAssignmentController::class)->only(['index', 'show']);

    // Notice Routes
    Route::resource('notices', StudentNoticeController::class)->only(['index', 'show']);

    // Fee Routes
    Route::resource('fees', StudentFeeController::class)->only(['index', 'show']);
});
