@extends('student.layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="h3">{{ $assignment->title }}</h1>
    <div class="card">
        <div class="card-body">
            <p><strong>Course:</strong> {{ $assignment->course->name ?? 'N/A' }}</p>
            <p><strong>Due:</strong> {{ optional($assignment->due_date)->toDateString() }}</p>
            <p>{{ $assignment->description }}</p>
        </div>
    </div>
</div>
@endsection
