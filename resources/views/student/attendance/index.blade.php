@extends('student.layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="h3 mb-3">Attendance</h1>

    <div class="mb-3">
        <p><strong>Total:</strong> {{ $totalAttendance }}</p>
        <p><strong>Present:</strong> {{ $presentCount }}</p>
        <p><strong>Absent:</strong> {{ $absentCount }}</p>
        <p><strong>Late:</strong> {{ $lateCount }}</p>
        <p><strong>Leave:</strong> {{ $leaveCount }}</p>
        <p><strong>Attendance %:</strong> {{ $attendancePercentage }}%</p>
    </div>

    <div class="card">
        <div class="card-body">
            @if($attendance->isEmpty())
                <p class="text-muted">No attendance records.</p>
            @else
                <ul class="list-group">
                    @foreach($attendance as $a)
                        <li class="list-group-item">
                            <strong>{{ $a->course->name ?? 'Course' }}</strong>
                            <div class="small text-muted">{{ $a->date }} — {{ ucfirst($a->status) }}</div>
                        </li>
                    @endforeach
                </ul>
            @endif
            <div class="mt-3">{{ $attendance->links() }}</div>
        </div>
    </div>
</div>
@endsection
