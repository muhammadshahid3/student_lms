@extends('admin.layouts.app')
@section('title', 'Edit Category')
@section('content')
<div class="content-header"><h1>Edit Category</h1></div>
<div class="card">
<div class="card-body">
<form action="{{ route('admin.categories.update', $category) }}" method="POST">
@csrf @method('PUT')
<div class="mb-3">
<label class="form-label">Name</label>
<input type="text" class="form-control" name="name" value="{{ $category->name }}" required>
</div>
<div class="mb-3">
<label class="form-label">Description</label>
<textarea class="form-control" name="description">{{ $category->description }}</textarea>
</div>
<div class="mb-3">
<label class="form-label">Icon</label>
<input type="text" class="form-control" name="icon" value="{{ $category->icon }}">
</div>
<div class="mb-3">
<label class="form-label">Position</label>
<input type="number" class="form-control" name="position" value="{{ $category->position }}">
</div>
<div class="mb-3">
<label class="form-check-label">
<input type="checkbox" class="form-check-input" name="is_active" value="1" {{ $category->is_active ? 'checked' : '' }}> Active
</label>
</div>
<button type="submit" class="btn btn-primary">Save</button>
</form>
</div>
</div>
@endsection
