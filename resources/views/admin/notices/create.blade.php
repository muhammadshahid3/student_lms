@extends('admin.layouts.app')
@section('title', 'Create Notice')
@section('content')
<div class="content-header"><h1>Create Notice</h1></div>
<div class="col-md-8"><div class="card"><div class="card-body">
<form action="{{ route('admin.notices.store') }}" method="POST" enctype="multipart/form-data">
@csrf
<div class="mb-3"><label>Title</label><input type="text" class="form-control" name="title" required></div>
<div class="mb-3"><label>Content</label><textarea class="form-control" name="content" rows="5" required></textarea></div>
<div class="mb-3"><label>Type</label>
<select class="form-control" name="type">
<option value="general">General</option>
<option value="urgent">Urgent</option>
<option value="academic">Academic</option>
<option value="event">Event</option>
</select></div>
<div class="mb-3"><label>Publish Date</label><input type="date" class="form-control" name="publish_date" required></div>
<div class="mb-3"><label>Expire Date</label><input type="date" class="form-control" name="expire_date"></div>
<button type="submit" class="btn btn-primary">Create</button>
</form>
</div></div></div>
@endsection
