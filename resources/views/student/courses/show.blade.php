@extends('student.layouts.app')

@section('content')
<div class="container py-4">
    <div class="mb-3">
        <h1 class="h3">{{ $course->name }} <small class="text-muted">({{ $course->code }})</small></h1>
        <p class="text-muted">Category: {{ $course->category->name ?? 'N/A' }}</p>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <h5>Description</h5>
            <p>{{ $course->description }}</p>
            <p><strong>Duration:</strong> {{ $course->duration_hours }} hours</p>
            <p><strong>Credits:</strong> {{ $course->credits }}</p>
            <p><strong>Fee:</strong> {{ number_format($course->fee) }}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Assignments</h5>
                    @if($course->assignments->isEmpty())
                        <p class="text-muted">No assignments yet.</p>
                    @else
                        <ul class="list-group">
                            @foreach($course->assignments as $assignment)
                                <li class="list-group-item">
                                    <strong>{{ $assignment->title }}</strong>
                                    <div class="small text-muted">Due: {{ optional($assignment->due_date)->toDateString() }}</div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Marks</h5>
                    @if($course->marks->isEmpty())
                        <p class="text-muted">No marks available.</p>
                    @else
                        <ul class="list-group">
                            @foreach($course->marks as $mark)
                                <li class="list-group-item">{{ $mark->assessment_name }}: {{ $mark->score }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
