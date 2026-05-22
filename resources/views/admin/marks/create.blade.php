@extends('admin.layouts.app')
@section('title', 'Upload Marks')
@section('content')
<div class="content-header"><h1>Upload Marks</h1></div>
<div class="col-md-8"><div class="card"><div class="card-body">
<form action="{{ route('admin.marks.store') }}" method="POST">
@csrf
<div class="mb-3"><label class="form-label">Student</label>
<select class="form-control" name="student_id" required>
@foreach($students as $s)
<option value="{{ $s->id }}">{{ $s->user->name }} ({{ $s->roll_number }})</option>
@endforeach
</select></div>
<div class="mb-3"><label class="form-label">Course</label>
<select class="form-control" name="course_id" required>
@foreach($courses as $c)
<option value="{{ $c->id }}">{{ $c->name }}</option>
@endforeach
</select></div>
<div class="mb-3"><label class="form-label">Exam Type</label>
<input type="text" class="form-control" name="exam_type" placeholder="e.g., Midterm, Final" required></div>
<div class="mb-3"><label class="form-label">Obtained Marks</label>
<input type="number" step="0.01" class="form-control" name="obtained_marks" required></div>
<div class="mb-3"><label class="form-label">Total Marks</label>
<input type="number" step="0.01" class="form-control" name="total_marks" required></div>
<div class="mb-3"><label class="form-label">Exam Date</label>
<input type="date" class="form-control" name="exam_date"></div>
<button type="submit" class="btn btn-primary">Upload</button>
</form>
</div></div></div>
@endsection
