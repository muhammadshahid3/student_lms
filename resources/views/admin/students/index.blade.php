@extends('admin.layouts.app')

@section('title', 'Manage Students')

@section('content')
    <div class="content-header d-flex justify-content-between align-items-center">
        <div>
            <h1><i class="fas fa-users"></i> Students Management</h1>
        </div>
        <a href="{{ route('admin.students.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Student
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="GET" class="row g-3 mb-3">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Search by name or email..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-control">
                        <option value="">All Status</option>
                        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="blocked" {{ request('status') === 'blocked' ? 'selected' : '' }}>Blocked</option>
                        <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="approval" class="form-control">
                        <option value="">All</option>
                        <option value="1" {{ request('approval') === '1' ? 'selected' : '' }}>Approved</option>
                        <option value="0" {{ request('approval') === '0' ? 'selected' : '' }}>Pending</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Search</button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Roll Number</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Approved</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($students as $student)
                            <tr>
                                <td>{{ $student->roll_number }}</td>
                                <td>{{ $student->user->name }}</td>
                                <td>{{ $student->user->email }}</td>
                                <td>
                                    @if ($student->status === 'active')
                                        <span class="badge bg-success">Active</span>
                                    @elseif ($student->status === 'blocked')
                                        <span class="badge bg-danger">Blocked</span>
                                    @else
                                        <span class="badge bg-warning">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($student->is_approved)
                                        <span class="badge bg-success">Yes</span>
                                    @else
                                        <span class="badge bg-warning">No</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.students.show', $student) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.students.edit', $student) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @if (!$student->is_approved)
                                        <form action="{{ route('admin.students.approve', $student) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success" title="Approve">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                    @endif
                                    @if ($student->status !== 'blocked')
                                        <form action="{{ route('admin.students.block', $student) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger" title="Block">
                                                <i class="fas fa-ban"></i>
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('admin.students.unblock', $student) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-warning" title="Unblock">
                                                <i class="fas fa-redo"></i>
                                            </button>
                                        </form>
                                    @endif
                                    <form action="{{ route('admin.students.destroy', $student) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">No students found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $students->links() }}
            </div>
        </div>
    </div>
@endsection
