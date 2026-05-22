@extends('admin.layouts.app')
@section('title', 'Create Course')
@section('content')
<div class="content-header"><h1>Create Course</h1></div>
<div class="col-md-8"><div class="card"><div class="card-body">
<form action="{{ route('admin.courses.store') }}" method="POST" enctype="multipart/form-data">
@csrf
<div class="mb-3">
<label class="form-label">Category</label>
<select class="form-control" name="category_id" required>
@foreach($categories as $c)
<option value="{{ $c->id }}">{{ $c->name }}</option>
@endforeach
</select>
</div>
<div class="mb-3">
<label class="form-label">Course Name</label>
<input type="text" class="form-control" name="name" required>
</div>
<div class="mb-3">
<label class="form-label">Course Code</label>
<input type="text" class="form-control" name="code" required>
</div>
<div class="mb-3">
<label class="form-label">Description</label>
<textarea class="form-control" name="description"></textarea>
</div>
<div class="mb-3">
<label class="form-label">Duration (Hours)</label>
<input type="number" class="form-control" name="duration_hours" required>
</div>
<div class="mb-3">
<label class="form-label">Credits</label>
<input type="number" class="form-control" name="credits" value="3">
</div>
<div class="mb-3">
<label class="form-label">Fee</label>
<input type="number" step="0.01" class="form-control" name="fee" required>
</div>
<div class="mb-3">
<label class="form-label">Course Image</label>
<input type="file" class="form-control" name="course_image" accept="image/*">
</div>
<button type="submit" class="btn btn-primary">Create</button>
</form>
</div></div></div>
@endsection
