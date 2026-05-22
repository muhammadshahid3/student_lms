@extends('admin.layouts.app')
@section('title', 'Attendance')
@section('content')
<div class="content-header d-flex justify-content-between">
<h1>Attendance</h1>
<a href="{{ route('admin.attendance.create') }}" class="btn btn-primary">Mark Attendance</a>
</div>
<div class="card"><div class="card-body">
<table class="table"><thead><tr><th>Student</th><th>Course</th><th>Date</th><th>Status</th><th>Actions</th></tr></thead>
<tbody>
@forelse($attendance as $att)
<tr><td>{{ $att->student->user->name }}</td><td>{{ $att->course->name }}</td><td>{{ $att->attendance_date->format('d M Y') }}</td>
<td><span class="badge bg-{{ $att->status === 'present' ? 'success' : ($att->status === 'absent' ? 'danger' : 'warning') }}">{{ ucfirst($att->status) }}</span></td>
<td><a href="{{ route('admin.attendance.edit', $att) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a></td>
</tr>
@empty
<tr><td colspan="5" class="text-center text-muted">No records</td></tr>
@endforelse
</tbody>
</table>
{{ $attendance->links() }}
</div></div>
@endsection
