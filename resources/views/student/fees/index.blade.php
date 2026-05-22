@extends('student.layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="h3 mb-3">Fees</h1>

    <div class="mb-3">
        <p><strong>Total:</strong> {{ number_format($totalFees, 2) }}</p>
        <p><strong>Paid:</strong> {{ number_format($paidAmount, 2) }}</p>
        <p><strong>Pending:</strong> {{ number_format($pendingAmount, 2) }}</p>
        <p><strong>Overdue:</strong> {{ $overdueFees }}</p>
    </div>

    <div class="card">
        <div class="card-body">
            @if($fees->isEmpty())
                <p class="text-muted">No fee records.</p>
            @else
                <ul class="list-group">
                    @foreach($fees as $fee)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ $fee->title ?? 'Fee' }}</strong>
                                <div class="small text-muted">Due: {{ optional($fee->due_date)->toDateString() }}</div>
                            </div>
                            <a href="{{ route('student.fees.show', $fee->id) }}" class="btn btn-sm btn-outline-primary">View</a>
                        </li>
                    @endforeach
                </ul>
            @endif
            <div class="mt-3">{{ $fees->links() }}</div>
        </div>
    </div>
</div>
@endsection
