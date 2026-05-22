<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Course;
use App\Models\Category;
use App\Models\Fee;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalStudents = Student::count();
        $approvedStudents = Student::where('is_approved', true)->count();
        $blockedStudents = Student::where('status', 'blocked')->count();
        $pendingApproval = Student::where('is_approved', false)->count();
        
        $totalCourses = Course::count();
        $totalCategories = Category::count();
        
        $totalFees = Fee::sum('amount');
        $paidFees = Fee::where('status', 'paid')->sum('paid_amount');
        $unpaidFees = Fee::where('status', 'unpaid')->sum('amount');
        
        $recentStudents = Student::latest()->take(5)->get();
        $recentCourses = Course::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalStudents',
            'approvedStudents',
            'blockedStudents',
            'pendingApproval',
            'totalCourses',
            'totalCategories',
            'totalFees',
            'paidFees',
            'unpaidFees',
            'recentStudents',
            'recentCourses'
        ));
    }
}
