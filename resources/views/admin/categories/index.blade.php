@extends('admin.layouts.app')

@section('title', 'Categories')

@section('content')
    <div class="content-header d-flex justify-content-between align-items-center">
        <h1><i class="fas fa-list"></i> Course Categories</h1>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add Category</a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr><th>Name</th><th>Icon</th><th>Position</th><th>Status</th><th>Actions</th></tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $cat)
                            <tr>
                                <td>{{ $cat->name }}</td>
                                <td><i class="{{ $cat->icon ?? 'fas fa-book' }}"></i></td>
                                <td>{{ $cat->position }}</td>
                                <td><span class="badge bg-{{ $cat->is_active ? 'success' : 'danger' }}">{{ $cat->is_active ? 'Active' : 'Inactive' }}</span></td>
                                <td>
                                    <a href="{{ route('admin.categories.edit', $cat) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('admin.categories.destroy', $cat) }}" method="POST" style="display:inline;" onsubmit="return confirm('Confirm?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center text-muted">No categories</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
