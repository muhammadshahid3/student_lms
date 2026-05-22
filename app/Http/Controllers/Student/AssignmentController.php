<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class AssignmentController extends Controller
{
    public function index(): View
    {
        $student = auth()->user()->student;
        $assignments = [];

        $enrolledCourses = $student->courses()
            ->where('enrollment_status', 'active')
            ->with('assignments')
            ->get();

        foreach ($enrolledCourses as $course) {
            foreach ($course->assignments()->where('is_active', true)->get() as $assignment) {
                $assignments[] = $assignment;
            }
        }

        usort($assignments, function ($a, $b) {
            return $a->due_date <=> $b->due_date;
        });

        $overduAssignments = array_filter($assignments, fn ($a) => $a->isOverdue());
        $upcomingAssignments = array_filter($assignments, fn ($a) => !$a->isOverdue());

        return view('student.assignments.index', compact('assignments', 'overduAssignments', 'upcomingAssignments'));
    }

    public function show($assignmentId): View
    {
        $student = auth()->user()->student;
        
        $assignment = null;
        $enrolledCourses = $student->courses()
            ->where('enrollment_status', 'active')
            ->with('assignments')
            ->get();

        foreach ($enrolledCourses as $course) {
            $courseAssignment = $course->assignments()->find($assignmentId);
            if ($courseAssignment) {
                $assignment = $courseAssignment;
                break;
            }
        }

        if (!$assignment) {
            abort(404);
        }

        return view('student.assignments.show', compact('assignment'));
    }
}
