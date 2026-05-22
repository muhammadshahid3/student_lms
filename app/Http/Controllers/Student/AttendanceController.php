<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class AttendanceController extends Controller
{
    public function index(): View
    {
        $student = auth()->user()->student;
        $attendance = $student->attendance()->with('course')->latest()->paginate(15);

        $totalAttendance = $student->attendance()->count();
        $presentCount = $student->attendance()->where('status', 'present')->count();
        $absentCount = $student->attendance()->where('status', 'absent')->count();
        $lateCount = $student->attendance()->where('status', 'late')->count();
        $leaveCount = $student->attendance()->where('status', 'leave')->count();

        $attendancePercentage = $totalAttendance > 0 
            ? round(($presentCount / $totalAttendance) * 100, 2)
            : 0;

        return view('student.attendance.index', compact(
            'attendance',
            'totalAttendance',
            'presentCount',
            'absentCount',
            'lateCount',
            'leaveCount',
            'attendancePercentage'
        ));
    }
}
