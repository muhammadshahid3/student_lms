@extends('student.layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="h3">Mark Details</h1>
    <div class="card">
        <div class="card-body">
            <p><strong>Course:</strong> {{ $mark->course->name ?? 'N/A' }}</p>
            <p><strong>Exam Type:</strong> {{ $mark->exam_type }}</p>
            <p><strong>Score:</strong> {{ $mark->obtained_marks }} / {{ $mark->total_marks }}</p>
            <p><strong>Percentage:</strong> {{ $mark->percentage }}%</p>
            <p><strong>Grade:</strong> {{ $mark->grade }}</p>
            <p><strong>Remarks:</strong> {{ $mark->remarks }}</p>
        </div>
    </div>
</div>
@endsection
