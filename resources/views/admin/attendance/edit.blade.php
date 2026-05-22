@extends('admin.layouts.app')
@section('title', 'Edit Attendance')
@section('content')
<div class="content-header"><h1>Edit Attendance</h1></div>
<div class="col-md-8"><div class="card"><div class="card-body">
<form action="{{ route('admin.attendance.update', $attendance) }}" method="POST">
@csrf @method('PUT')
<div class="mb-3"><label>Status</label>
<select class="form-control" name="status">
<option value="present" {{ $attendance->status === 'present' ? 'selected' : '' }}>Present</option>
<option value="absent" {{ $attendance->status === 'absent' ? 'selected' : '' }}>Absent</option>
<option value="late" {{ $attendance->status === 'late' ? 'selected' : '' }}>Late</option>
<option value="leave" {{ $attendance->status === 'leave' ? 'selected' : '' }}>Leave</option>
</select></div>
<div class="mb-3"><textarea class="form-control" name="remarks">{{ $attendance->remarks }}</textarea></div>
<button type="submit" class="btn btn-primary">Update</button>
</form>
</div></div></div>
@endsection
