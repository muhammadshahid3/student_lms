@extends('admin.layouts.app')
@section('title', 'Fees')
@section('content')
<div class="content-header d-flex justify-content-between">
<h1>Fees Management</h1>
<a href="{{ route('admin.fees.create') }}" class="btn btn-primary">Add Fee</a>
</div>
<div class="card"><div class="card-body">
<table class="table"><thead><tr><th>Student</th><th>Amount</th><th>Type</th><th>Status</th><th>Due Date</th><th>Actions</th></tr></thead>
<tbody>
@forelse($fees as $fee)
<tr><td>{{ $fee->student->user->name }}</td><td>Rs. {{ number_format($fee->amount, 2) }}</td><td>{{ ucfirst($fee->fee_type) }}</td>
<td><span class="badge bg-{{ $fee->status === 'paid' ? 'success' : 'warning' }}">{{ ucfirst($fee->status) }}</span></td>
<td>{{ $fee->due_date->format('d M Y') }}</td>
<td><a href="{{ route('admin.fees.edit', $fee) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a></td>
</tr>
@empty
<tr><td colspan="6" class="text-center text-muted">No fees</td></tr>
@endforelse
</tbody>
</table>
{{ $fees->links() }}
</div></div>
@endsection
