@extends('admin.layouts.app')
@section('title', 'Notices')
@section('content')
<div class="content-header d-flex justify-content-between">
<h1>Notices</h1>
<a href="{{ route('admin.notices.create') }}" class="btn btn-primary">Add Notice</a>
</div>
<div class="card"><div class="card-body">
<table class="table"><thead><tr><th>Title</th><th>Type</th><th>Date</th><th>Active</th><th>Actions</th></tr></thead>
<tbody>
@forelse($notices as $n)
<tr><td>{{ $n->title }}</td><td><span class="badge">{{ ucfirst($n->type) }}</span></td><td>{{ $n->publish_date->format('d M Y') }}</td>
<td><span class="badge bg-{{ $n->is_active ? 'success' : 'danger' }}">{{ $n->is_active ? 'Yes' : 'No' }}</span></td>
<td><a href="{{ route('admin.notices.edit', $n) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
<form action="{{ route('admin.notices.destroy', $n) }}" method="POST" style="display:inline;">@csrf @method('DELETE')<button class="btn btn-sm btn-danger" onclick="return confirm('Confirm?')"><i class="fas fa-trash"></i></button></form></td>
</tr>
@empty
<tr><td colspan="5" class="text-center text-muted">No notices</td></tr>
@endforelse
</tbody>
</table>
</div></div>
@endsection
