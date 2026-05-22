@extends('admin.layouts.app')
@section('title', 'Edit Notice')
@section('content')
<div class="content-header"><h1>Edit Notice</h1></div>
<div class="col-md-8"><div class="card"><div class="card-body">
<form action="{{ route('admin.notices.update', $notice) }}" method="POST">
@csrf @method('PUT')
<div class="mb-3"><input type="text" class="form-control" name="title" value="{{ $notice->title }}" required></div>
<div class="mb-3"><textarea class="form-control" name="content" rows="5" required>{{ $notice->content }}</textarea></div>
<div class="mb-3">
<label class="form-check-label">
<input type="checkbox" class="form-check-input" name="is_active" value="1" {{ $notice->is_active ? 'checked' : '' }}> Active
</label>
</div>
<button type="submit" class="btn btn-primary">Update</button>
</form>
</div></div></div>
@endsection
