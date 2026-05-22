<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $student = auth()->user()->student;
        $student->load('courses', 'marks', 'fees', 'attendance');

        $enrolledCoursesCount = $student->courses()->where('enrollment_status', 'active')->count();
        $totalMarksReceived = $student->marks()->count();
        $attendancePercentage = $this->calculateAttendancePercentage($student);
        $pendingFees = $student->fees()->where('status', '!=', 'paid')->sum('amount');

        return view('student.dashboard', compact(
            'student',
            'enrolledCoursesCount',
            'totalMarksReceived',
            'attendancePercentage',
            'pendingFees'
        ));
    }

    private function calculateAttendancePercentage($student): float
    {
        $attendance = $student->attendance;
        if ($attendance->count() === 0) {
            return 0;
        }

        $presentCount = $attendance->whereIn('status', ['present', 'late'])->count();
        return round(($presentCount / $attendance->count()) * 100, 2);
    }
}
