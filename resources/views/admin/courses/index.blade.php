@extends('admin.layouts.app')

@section('title', 'Manage Courses')

@section('content')
    <div class="content-header d-flex justify-content-between align-items-center">
        <div>
            <h1><i class="fas fa-book"></i> Courses Management</h1>
        </div>
        <a href="{{ route('admin.courses.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Course
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="GET" class="row g-3 mb-3">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Search by name or code..." value="{{ request('search') }}">
                </div>
                <div class="col-md-4">
                    <select name="category" class="form-control">
                        <option value="">All Categories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary w-100">Search</button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Course Code</th>
                            <th>Course Name</th>
                            <th>Category</th>
                            <th>Credits</th>
                            <th>Fee</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($courses as $course)
                            <tr>
                                <td>{{ $course->code }}</td>
                                <td>{{ $course->name }}</td>
                                <td>{{ $course->category->name }}</td>
                                <td>{{ $course->credits }}</td>
                                <td>Rs. {{ number_format($course->fee, 2) }}</td>
                                <td>
                                    @if ($course->is_active)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.courses.show', $course) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.courses.edit', $course) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.courses.destroy', $course) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?')">
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
                                <td colspan="7" class="text-center text-muted">No courses found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $courses->links() }}
            </div>
        </div>
    </div>
@endsection
