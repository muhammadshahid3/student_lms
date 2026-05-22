@extends('admin.layouts.app')
@section('title', 'Course Details')
@section('content')
<div class="content-header"><h1>{{ $course->name }}</h1></div>
<div class="row">
<div class="col-md-8"><div class="card"><div class="card-body">
<h5 class="card-title">Course Information</h5>
<table class="table">
<tr><th>Code</th><td>{{ $course->code }}</td></tr>
<tr><th>Category</th><td>{{ $course->category->name }}</td></tr>
<tr><th>Credits</th><td>{{ $course->credits }}</td></tr>
<tr><th>Fee</th><td>Rs. {{ number_format($course->fee, 2) }}</td></tr>
<tr><th>Duration</th><td>{{ $course->duration_hours }} hours</td></tr>
</table>
</div></div></div>
<div class="col-md-4"><div class="card"><div class="card-body">
<h5 class="card-title">Stats</h5>
<p>Enrolled: {{ $course->students()->count() }} students</p>
<p>Assignments: {{ $course->assignments()->count() }}</p>
<a href="{{ route('admin.courses.edit', $course) }}" class="btn btn-primary btn-sm">Edit</a>
</div></div></div>
</div>
@endsection
