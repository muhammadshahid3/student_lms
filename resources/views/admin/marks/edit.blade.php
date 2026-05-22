@extends('admin.layouts.app')
@section('title', 'Edit Marks')
@section('content')
<div class="content-header"><h1>Edit Marks</h1></div>
<div class="col-md-8"><div class="card"><div class="card-body">
<form action="{{ route('admin.marks.update', $mark) }}" method="POST">
@csrf @method('PUT')
<div class="mb-3"><input type="number" step="0.01" class="form-control" name="obtained_marks" value="{{ $mark->obtained_marks }}" required></div>
<div class="mb-3"><input type="number" step="0.01" class="form-control" name="total_marks" value="{{ $mark->total_marks }}" required></div>
<div class="mb-3"><textarea class="form-control" name="remarks">{{ $mark->remarks }}</textarea></div>
<button type="submit" class="btn btn-primary">Update</button>
</form>
</div></div></div>
@endsection
