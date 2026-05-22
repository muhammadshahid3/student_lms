<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Student;
use App\Models\Admin;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLoginForm(): View
    {
        return view('auth.login');
    }

    public function showAdminLoginForm(): View
    {
        return view('auth.admin-login');
    }

    public function showStudentRegisterForm(): View
    {
        return view('auth.student-register');
    }

    public function showAdminRegisterForm(): View
    {
        return view('auth.admin-register');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            $user = Auth::user();
            if ($user->isAdmin()) {
                return redirect()->intended('/admin/dashboard');
            } elseif ($user->isStudent()) {
                return redirect()->intended('/student/dashboard');
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function adminLogin(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt(array_merge($credentials, ['role' => 'admin']))) {
            $request->session()->regenerate();
            return redirect()->intended('/admin/dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function studentRegister(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string', 'max:255'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'student',
        ]);

        Student::create([
            'user_id' => $user->id,
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'roll_number' => 'STD' . str_pad($user->id, 6, '0', STR_PAD_LEFT),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect('/student/dashboard')->with('success', 'Registration successful! Your account is pending admin approval.');
    }

    public function adminRegister(Request $request): RedirectResponse
    {
        // Admin registration might be restricted. You can implement it based on your requirements.
        return back()->with('error', 'Admin registration is restricted. Contact system administrator.');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
