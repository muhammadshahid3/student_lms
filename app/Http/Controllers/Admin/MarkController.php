<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mark;
use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MarkController extends Controller
{
    public function index(Request $request): View
    {
        $query = Mark::with('student', 'course');

        if ($request->has('student_id') && $request->student_id !== '') {
            $query->where('student_id', $request->student_id);
        }

        if ($request->has('course_id') && $request->course_id !== '') {
            $query->where('course_id', $request->course_id);
        }

        $marks = $query->paginate(15);
        $students = Student::with('user')->get();
        $courses = Course::get();

        return view('admin.marks.index', compact('marks', 'students', 'courses'));
    }

    public function create(): View
    {
        $students = Student::with('user')->where('is_approved', true)->get();
        $courses = Course::where('is_active', true)->get();
        return view('admin.marks.create', compact('students', 'courses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
            'exam_type' => 'required|string|max:50',
            'obtained_marks' => 'required|numeric|min:0',
            'total_marks' => 'required|numeric|min:0.01',
            'exam_date' => 'nullable|date',
            'remarks' => 'nullable|string',
        ]);

        Mark::create(array_merge($validated, [
            'uploaded_by' => auth()->user()->admin->id,
        ]));

        return redirect()->route('admin.marks.index')->with('success', 'Marks uploaded successfully.');
    }

    public function edit(Mark $mark): View
    {
        $students = Student::with('user')->get();
        $courses = Course::get();
        return view('admin.marks.edit', compact('mark', 'students', 'courses'));
    }

    public function update(Request $request, Mark $mark)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
            'exam_type' => 'required|string|max:50',
            'obtained_marks' => 'required|numeric|min:0',
            'total_marks' => 'required|numeric|min:0.01',
            'exam_date' => 'nullable|date',
            'remarks' => 'nullable|string',
        ]);

        $mark->update($validated);

        return redirect()->route('admin.marks.index')->with('success', 'Marks updated successfully.');
    }

    public function destroy(Mark $mark)
    {
        $mark->delete();

        return redirect()->route('admin.marks.index')->with('success', 'Mark record deleted successfully.');
    }
}
