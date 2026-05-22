@extends('admin.layouts.app')

@section('title', 'Add Category')

@section('content')
    <div class="content-header"><h1><i class="fas fa-plus"></i> Add Category</h1></div>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" name="description"></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Icon</label>
                    <input type="text" class="form-control" name="icon" placeholder="e.g., fas fa-book">
                </div>
                <div class="mb-3">
                    <label class="form-label">Position</label>
                    <input type="number" class="form-control" name="position" value="0">
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
@endsection
