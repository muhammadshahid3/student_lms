@extends('admin.layouts.app')
@section('title', 'Mark Attendance')
@section('content')
<div class="content-header"><h1>Mark Attendance</h1></div>
<div class="col-md-8"><div class="card"><div class="card-body">
<form action="{{ route('admin.attendance.store') }}" method="POST">
@csrf
<div class="mb-3"><label>Course</label>
<select class="form-control" name="course_id" id="courseId" required onchange="loadStudents()">
<option value="">Select Course</option>
@foreach($courses as $c)
<option value="{{ $c->id }}">{{ $c->name }}</option>
@endforeach
</select></div>
<div class="mb-3"><label>Date</label>
<input type="date" class="form-control" name="attendance_date" required></div>
<div id="students-list"></div>
<button type="submit" class="btn btn-primary">Mark Attendance</button>
</form>
</div></div></div>
<script>
function loadStudents() {
    let courseId = document.getElementById('courseId').value;
    if (!courseId) return;
    fetch(`/admin/attendance/get-students-by-class?course_id=${courseId}`)
        .then(r => r.json())
        .then(students => {
            let html = '<table class="table"><thead><tr><th>Student</th><th>Status</th></tr></thead><tbody>';
            students.forEach(s => {
                html += `<tr><td>${s.user.name}</td><td>
                <select class="form-control" name="attendance[${s.id}][status]" required>
                <option value="present">Present</option>
                <option value="absent">Absent</option>
                <option value="late">Late</option>
                <option value="leave">Leave</option>
                </select></td></tr>`;
            });
            html += '</tbody></table>';
            document.getElementById('students-list').innerHTML = html;
        });
}
</script>
@endsection
