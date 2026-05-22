<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class CourseController extends Controller
{
    public function index(): View
    {
        $student = auth()->user()->student;
        $courses = $student->courses()->where('enrollment_status', 'active')->paginate(12);

        return view('student.courses.index', compact('courses'));
    }

    public function show($courseId): View
    {
        $student = auth()->user()->student;
        $course = $student->courses()
            ->where('courses.id', $courseId)
            ->where('enrollment_status', 'active')
            ->firstOrFail();

        $course->load('assignments', 'marks');

        return view('student.courses.show', compact('course'));
    }
}
