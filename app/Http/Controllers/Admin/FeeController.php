<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fee;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FeeController extends Controller
{
    public function index(Request $request): View
    {
        $query = Fee::with('student', 'student.user');

        if ($request->has('student_id') && $request->student_id !== '') {
            $query->where('student_id', $request->student_id);
        }

        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        $fees = $query->paginate(15);
        $students = Student::with('user')->get();

        return view('admin.fees.index', compact('fees', 'students'));
    }

    public function create(): View
    {
        $students = Student::with('user')->where('is_approved', true)->get();
        return view('admin.fees.create', compact('students'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'amount' => 'required|numeric|min:0.01',
            'fee_type' => 'required|in:tuition,lab,library,transport,other',
            'due_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        Fee::create(array_merge($validated, [
            'updated_by' => auth()->user()->admin->id,
        ]));

        return redirect()->route('admin.fees.index')->with('success', 'Fee record created successfully.');
    }

    public function edit(Fee $fee): View
    {
        $students = Student::with('user')->get();
        return view('admin.fees.edit', compact('fee', 'students'));
    }

    public function update(Request $request, Fee $fee)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'fee_type' => 'required|in:tuition,lab,library,transport,other',
            'due_date' => 'required|date',
            'status' => 'required|in:unpaid,partial,paid',
            'paid_amount' => 'required|numeric|min:0|max:' . $validated['amount'] ?? $fee->amount,
            'paid_date' => 'nullable|date',
            'transaction_id' => 'nullable|string|max:100',
            'payment_method' => 'nullable|string|max:50',
            'notes' => 'nullable|string',
        ]);

        $fee->update(array_merge($validated, [
            'updated_by' => auth()->user()->admin->id,
        ]));

        return redirect()->route('admin.fees.index')->with('success', 'Fee record updated successfully.');
    }

    public function destroy(Fee $fee)
    {
        $fee->delete();

        return redirect()->route('admin.fees.index')->with('success', 'Fee record deleted successfully.');
    }

    public function markAsPaid(Fee $fee)
    {
        $fee->update([
            'status' => 'paid',
            'paid_amount' => $fee->amount,
            'paid_date' => now(),
            'updated_by' => auth()->user()->admin->id,
        ]);

        return back()->with('success', 'Fee marked as paid.');
    }
}
