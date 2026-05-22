<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StudentController extends Controller
{
    public function index(Request $request): View
    {
        $query = Student::with('user');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%");
            })->orWhere('roll_number', 'like', "%$search%");
        }

        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        if ($request->has('approval') && $request->approval !== '') {
            $query->where('is_approved', $request->approval);
        }

        $students = $query->paginate(15);

        return view('admin.students.index', compact('students'));
    }

    public function create(): View
    {
        return view('admin.students.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'date_of_birth' => 'nullable|date',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => 'student',
        ]);

        Student::create([
            'user_id' => $user->id,
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'date_of_birth' => $validated['date_of_birth'],
            'roll_number' => 'STD' . str_pad($user->id, 6, '0', STR_PAD_LEFT),
        ]);

        return redirect()->route('admin.students.index')->with('success', 'Student created successfully.');
    }

    public function show(Student $student): View
    {
        $student->load('user', 'courses', 'fees', 'marks');
        return view('admin.students.show', compact('student'));
    }

    public function edit(Student $student): View
    {
        return view('admin.students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $student->user_id,
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'date_of_birth' => 'nullable|date',
            'status' => 'required|in:active,blocked,inactive',
            'is_approved' => 'required|boolean',
            'total_fees' => 'required|numeric|min:0',
            'remarks' => 'nullable|string',
        ]);

        $student->user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        $student->update([
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'date_of_birth' => $validated['date_of_birth'],
            'status' => $validated['status'],
            'is_approved' => $validated['is_approved'],
            'total_fees' => $validated['total_fees'],
            'remarks' => $validated['remarks'],
        ]);

        return redirect()->route('admin.students.index')->with('success', 'Student updated successfully.');
    }

    public function destroy(Student $student)
    {
        $student->user->delete();
        
        return redirect()->route('admin.students.index')->with('success', 'Student deleted successfully.');
    }

    public function approve(Student $student)
    {
        $student->update(['is_approved' => true, 'status' => 'active']);
        
        return back()->with('success', 'Student approved successfully.');
    }

    public function block(Student $student)
    {
        $student->update(['status' => 'blocked']);
        
        return back()->with('success', 'Student blocked successfully.');
    }

    public function unblock(Student $student)
    {
        $student->update(['status' => 'active']);
        
        return back()->with('success', 'Student unblocked successfully.');
    }
}
