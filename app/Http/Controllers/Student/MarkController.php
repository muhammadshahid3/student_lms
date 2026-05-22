<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class MarkController extends Controller
{
    public function index(): View
    {
        $student = auth()->user()->student;
        $marks = $student->marks()->with('course')->paginate(15);

        $avgPercentage = $student->marks()->average('percentage');
        $passedCourses = $student->marks()->where('is_passed', true)->count();
        $totalCourses = $student->marks()->count();

        return view('student.marks.index', compact('marks', 'avgPercentage', 'passedCourses', 'totalCourses'));
    }

    public function show($markId): View
    {
        $student = auth()->user()->student;
        $mark = $student->marks()
            ->where('marks.id', $markId)
            ->with('course')
            ->firstOrFail();

        return view('student.marks.show', compact('mark'));
    }
}
