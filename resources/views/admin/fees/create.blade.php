@extends('admin.layouts.app')
@section('title','Create Fee')
@section('content')
<div class="content-header"><h1>Create Fee</h1></div>
<div class="card"><div class="card-body">
<form action="{{ route('admin.fees.store') }}" method="POST">
@csrf
<div class="mb-3"><label>Student</label><select class="form-control" name="student_id">@foreach($students as $s)<option value="{{ $s->id }}">{{ $s->user->name }}</option>@endforeach</select></div>
<div class="mb-3"><label>Amount</label><input type="number" step="0.01" class="form-control" name="amount" required></div>
<div class="mb-3"><label>Fee Type</label><select class="form-control" name="fee_type"><option value="tuition">Tuition</option><option value="lab">Lab</option><option value="library">Library</option><option value="transport">Transport</option><option value="other">Other</option></select></div>
<div class="mb-3"><label>Due Date</label><input type="date" class="form-control" name="due_date" required></div>
<button class="btn btn-primary">Create</button>
</form>
</div></div>
@endsection