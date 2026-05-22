<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StudentApprovedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        if (auth()->user()->isStudent()) {
            $student = auth()->user()->student;
            
            if (!$student || !$student->is_approved) {
                auth()->logout();
                return redirect('/login')->with('error', 'Your account is pending approval. Please wait for admin approval.');
            }

            if ($student->status === 'blocked') {
                auth()->logout();
                return redirect('/login')->with('error', 'Your account has been blocked.');
            }
        }

        return $next($request);
    }
}
