@extends('admin.layouts.app')
@section('title', 'Marks')
@section('content')
<div class="content-header d-flex justify-content-between">
<h1>Marks Management</h1>
<a href="{{ route('admin.marks.create') }}" class="btn btn-primary">Add Marks</a>
</div>
<div class="card"><div class="card-body">
<table class="table">
<thead><tr><th>Student</th><th>Course</th><th>Type</th><th>Marks</th><th>Percentage</th><th>Grade</th><th>Actions</th></tr></thead>
<tbody>
@forelse($marks as $mark)
<tr>
<td>{{ $mark->student->user->name }}</td>
<td>{{ $mark->course->name }}</td>
<td>{{ $mark->exam_type }}</td>
<td>{{ $mark->obtained_marks }}/{{ $mark->total_marks }}</td>
<td>{{ round($mark->percentage, 2) }}%</td>
<td><strong>{{ $mark->grade }}</strong></td>
<td>
<a href="{{ route('admin.marks.edit', $mark) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
<form action="{{ route('admin.marks.destroy', $mark) }}" method="POST" style="display:inline;">@csrf @method('DELETE')<button class="btn btn-sm btn-danger" onclick="return confirm('Confirm?')"><i class="fas fa-trash"></i></button></form>
</td>
</tr>
@empty
<tr><td colspan="7" class="text-center text-muted">No marks found</td></tr>
@endforelse
</tbody>
</table>
{{ $marks->links() }}
</div></div>
@endsection
