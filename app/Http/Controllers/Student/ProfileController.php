<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function show(): View
    {
        $student = auth()->user()->student;
        return view('student.profile.show', compact('student'));
    }

    public function edit(): View
    {
        $student = auth()->user()->student;
        return view('student.profile.edit', compact('student'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'date_of_birth' => 'nullable|date|before:today',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = auth()->user();
        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        $student = $user->student;
        $avatarPath = $student->avatar;
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
        }

        $student->update([
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'date_of_birth' => $validated['date_of_birth'],
            'avatar' => $avatarPath,
        ]);

        return redirect()->route('student.profile.show')->with('success', 'Profile updated successfully.');
    }
}
