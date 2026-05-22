@extends('student.layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="h3 mb-3">Marks</h1>

    <div class="mb-3">
        <p><strong>Average Percentage:</strong> {{ number_format($avgPercentage ?? 0, 2) }}%</p>
        <p><strong>Passed Courses:</strong> {{ $passedCourses ?? 0 }} / {{ $totalCourses ?? 0 }}</p>
    </div>

    <div class="card">
        <div class="card-body">
            @if($marks->isEmpty())
                <p class="text-muted">No marks found.</p>
            @else
                <ul class="list-group">
                    @foreach($marks as $mark)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ $mark->course->name ?? 'Course' }}</strong>
                                <div class="small text-muted">{{ $mark->exam_type }} — {{ $mark->percentage }}%</div>
                            </div>
                            <a href="{{ route('student.marks.show', $mark->id) }}" class="btn btn-sm btn-outline-primary">View</a>
                        </li>
                    @endforeach
                </ul>
            @endif
            <div class="mt-3">{{ $marks->links() }}</div>
        </div>
    </div>
</div>
@endsection
