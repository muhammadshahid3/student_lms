<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class FeeController extends Controller
{
    public function index(): View
    {
        $student = auth()->user()->student;
        $fees = $student->fees()->latest()->paginate(15);

        $totalFees = $student->fees()->sum('amount');
        $paidAmount = $student->fees()->where('status', 'paid')->sum('paid_amount');
        $pendingAmount = $totalFees - $paidAmount;
        $overdueFees = $student->fees()
            ->where('status', '!=', 'paid')
            ->where('due_date', '<', now())
            ->count();

        return view('student.fees.index', compact(
            'fees',
            'totalFees',
            'paidAmount',
            'pendingAmount',
            'overdueFees'
        ));
    }

    public function show($feeId): View
    {
        $student = auth()->user()->student;
        $fee = $student->fees()->findOrFail($feeId);

        return view('student.fees.show', compact('fee'));
    }
}
