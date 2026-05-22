<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AttendanceController extends Controller
{
    public function index(Request $request): View
    {
        $query = Attendance::with('student', 'course');

        if ($request->has('course_id') && $request->course_id !== '') {
            $query->where('course_id', $request->course_id);
        }

        if ($request->has('date')) {
            $query->where('attendance_date', $request->date);
        }

        $attendance = $query->paginate(15);
        $courses = Course::where('is_active', true)->get();

        return view('admin.attendance.index', compact('attendance', 'courses'));
    }

    public function create(): View
    {
        $courses = Course::where('is_active', true)->get();
        return view('admin.attendance.create', compact('courses'));
    }

    public function getStudentsByClass(Request $request)
    {
        $students = Student::whereHas('courses', function ($q) use ($request) {
            $q->where('courses.id', $request->course_id)
              ->where('enrollment_status', 'active');
        })->with('user')->get();

        return response()->json($students);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'attendance_date' => 'required|date',
            'attendance' => 'required|array',
            'attendance.*.student_id' => 'required|exists:students,id',
            'attendance.*.status' => 'required|in:present,absent,late,leave',
            'attendance.*.remarks' => 'nullable|string',
        ]);

        foreach ($validated['attendance'] as $attendanceData) {
            Attendance::updateOrCreate(
                [
                    'student_id' => $attendanceData['student_id'],
                    'course_id' => $validated['course_id'],
                    'attendance_date' => $validated['attendance_date'],
                ],
                [
                    'status' => $attendanceData['status'],
                    'remarks' => $attendanceData['remarks'] ?? null,
                    'marked_by' => auth()->user()->admin->id,
                ]
            );
        }

        return redirect()->route('admin.attendance.index')->with('success', 'Attendance marked successfully.');
    }

    public function edit(Attendance $attendance): View
    {
        return view('admin.attendance.edit', compact('attendance'));
    }

    public function update(Request $request, Attendance $attendance)
    {
        $validated = $request->validate([
            'status' => 'required|in:present,absent,late,leave',
            'remarks' => 'nullable|string',
        ]);

        $attendance->update($validated);

        return redirect()->route('admin.attendance.index')->with('success', 'Attendance updated successfully.');
    }

    public function destroy(Attendance $attendance)
    {
        $attendance->delete();

        return redirect()->route('admin.attendance.index')->with('success', 'Attendance record deleted successfully.');
    }
}
