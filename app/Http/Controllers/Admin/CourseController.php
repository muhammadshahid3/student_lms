<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CourseController extends Controller
{
    public function index(Request $request): View
    {
        $query = Course::with('category', 'admin');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%$search%")
                  ->orWhere('code', 'like', "%$search%");
        }

        if ($request->has('category') && $request->category !== '') {
            $query->where('category_id', $request->category);
        }

        $courses = $query->paginate(15);
        $categories = Category::where('is_active', true)->get();

        return view('admin.courses.index', compact('courses', 'categories'));
    }

    public function create(): View
    {
        $categories = Category::where('is_active', true)->get();
        return view('admin.courses.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|unique:courses|max:255',
            'code' => 'required|string|unique:courses|max:50',
            'description' => 'nullable|string',
            'duration_hours' => 'required|integer|min:1',
            'credits' => 'required|integer|min:1',
            'fee' => 'required|numeric|min:0',
            'course_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('course_image')) {
            $imagePath = $request->file('course_image')->store('courses', 'public');
        }

        Course::create([
            'category_id' => $validated['category_id'],
            'created_by' => auth()->user()->admin->id,
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'code' => $validated['code'],
            'description' => $validated['description'],
            'duration_hours' => $validated['duration_hours'],
            'credits' => $validated['credits'],
            'fee' => $validated['fee'],
            'course_image' => $imagePath,
        ]);

        return redirect()->route('admin.courses.index')->with('success', 'Course created successfully.');
    }

    public function edit(Course $course): View
    {
        $categories = Category::where('is_active', true)->get();
        return view('admin.courses.edit', compact('course', 'categories'));
    }

    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|unique:courses,name,' . $course->id . '|max:255',
            'code' => 'required|string|unique:courses,code,' . $course->id . '|max:50',
            'description' => 'nullable|string',
            'duration_hours' => 'required|integer|min:1',
            'credits' => 'required|integer|min:1',
            'fee' => 'required|numeric|min:0',
            'course_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'required|boolean',
        ]);

        $imagePath = $course->course_image;
        if ($request->hasFile('course_image')) {
            $imagePath = $request->file('course_image')->store('courses', 'public');
        }

        $course->update([
            'category_id' => $validated['category_id'],
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'code' => $validated['code'],
            'description' => $validated['description'],
            'duration_hours' => $validated['duration_hours'],
            'credits' => $validated['credits'],
            'fee' => $validated['fee'],
            'course_image' => $imagePath,
            'is_active' => $validated['is_active'],
        ]);

        return redirect()->route('admin.courses.index')->with('success', 'Course updated successfully.');
    }

    public function destroy(Course $course)
    {
        if ($course->students()->exists()) {
            return back()->with('error', 'Cannot delete course with enrolled students.');
        }

        $course->delete();

        return redirect()->route('admin.courses.index')->with('success', 'Course deleted successfully.');
    }

    public function show(Course $course): View
    {
        $course->load('students', 'assignments', 'marks');
        return view('admin.courses.show', compact('course'));
    }
}
