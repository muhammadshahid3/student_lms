@extends('student.layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="h3 mb-3">Assignments</h1>

    @if(empty($assignments))
        <p class="text-muted">No assignments available.</p>
    @else
        <ul class="list-group">
            @foreach($assignments as $assignment)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong>{{ $assignment->title }}</strong>
                        <div class="small text-muted">Due: {{ optional($assignment->due_date)->toDateString() }}</div>
                    </div>
                    <a href="{{ route('student.assignments.show', $assignment->id) }}" class="btn btn-sm btn-outline-primary">View</a>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
