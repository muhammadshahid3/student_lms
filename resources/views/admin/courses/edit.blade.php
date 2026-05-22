@extends('admin.layouts.app')
@section('title', 'Edit Course')
@section('content')
<div class="content-header"><h1>Edit Course</h1></div>
<div class="col-md-8"><div class="card"><div class="card-body">
<form action="{{ route('admin.courses.update', $course) }}" method="POST" enctype="multipart/form-data">
@csrf @method('PUT')
<div class="mb-3">
<label class="form-label">Category</label>
<select class="form-control" name="category_id" required>
@foreach($categories as $c)
<option value="{{ $c->id }}" {{ $course->category_id == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
@endforeach
</select>
</div>
<div class="mb-3">
<label class="form-label">Course Name</label>
<input type="text" class="form-control" name="name" value="{{ $course->name }}" required>
</div>
<div class="mb-3">
<label class="form-label">Course Code</label>
<input type="text" class="form-control" name="code" value="{{ $course->code }}" required>
</div>
<div class="mb-3">
<label class="form-label">Fee</label>
<input type="number" step="0.01" class="form-control" name="fee" value="{{ $course->fee }}" required>
</div>
<div class="mb-3">
<label class="form-check-label">
<input type="checkbox" class="form-check-input" name="is_active" value="1" {{ $course->is_active ? 'checked' : '' }}> Active
</label>
</div>
<button type="submit" class="btn btn-primary">Update</button>
</form>
</div></div></div>
@endsection
