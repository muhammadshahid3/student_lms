<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AssignmentController extends Controller
{
    public function index(Request $request): View
    {
        $query = Assignment::with('course', 'admin');

        if ($request->has('course_id') && $request->course_id !== '') {
            $query->where('course_id', $request->course_id);
        }

        $assignments = $query->paginate(15);
        $courses = Course::where('is_active', true)->get();

        return view('admin.assignments.index', compact('assignments', 'courses'));
    }

    public function create(): View
    {
        $courses = Course::where('is_active', true)->get();
        return view('admin.assignments.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'instructions' => 'nullable|string',
            'due_date' => 'required|date|after_or_equal:today',
            'marks' => 'required|integer|min:1',
            'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png,zip|max:5120',
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('assignments', 'public');
        }

        Assignment::create([
            'course_id' => $validated['course_id'],
            'created_by' => auth()->user()->admin->id,
            'title' => $validated['title'],
            'description' => $validated['description'],
            'instructions' => $validated['instructions'],
            'file_path' => $filePath,
            'due_date' => $validated['due_date'],
            'marks' => $validated['marks'],
        ]);

        return redirect()->route('admin.assignments.index')->with('success', 'Assignment created successfully.');
    }

    public function edit(Assignment $assignment): View
    {
        $courses = Course::where('is_active', true)->get();
        return view('admin.assignments.edit', compact('assignment', 'courses'));
    }

    public function update(Request $request, Assignment $assignment)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'instructions' => 'nullable|string',
            'due_date' => 'required|date',
            'marks' => 'required|integer|min:1',
            'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png,zip|max:5120',
            'is_active' => 'required|boolean',
        ]);

        $filePath = $assignment->file_path;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('assignments', 'public');
        }

        $assignment->update([
            'course_id' => $validated['course_id'],
            'title' => $validated['title'],
            'description' => $validated['description'],
            'instructions' => $validated['instructions'],
            'due_date' => $validated['due_date'],
            'marks' => $validated['marks'],
            'file_path' => $filePath,
            'is_active' => $validated['is_active'],
        ]);

        return redirect()->route('admin.assignments.index')->with('success', 'Assignment updated successfully.');
    }

    public function destroy(Assignment $assignment)
    {
        $assignment->delete();

        return redirect()->route('admin.assignments.index')->with('success', 'Assignment deleted successfully.');
    }
}
