@extends('admin.layouts.app')

@section('title', 'Edit Student')

@section('content')
    <div class="content-header">
        <h1><i class="fas fa-edit"></i> Edit Student</h1>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.students.update', $student) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" value="{{ $student->user->name }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-control" name="status" required>
                                <option value="active" {{ $student->status === 'active' ? 'selected' : '' }}>Active</option>
                                <option value="blocked" {{ $student->status === 'blocked' ? 'selected' : '' }}>Blocked</option>
                                <option value="inactive" {{ $student->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="is_approved" class="form-label">Approve Student</label>
                            <input type="checkbox" class="form-check-input" name="is_approved" value="1" {{ $student->is_approved ? 'checked' : '' }}>
                        </div>

                        <div class="mb-3">
                            <label for="total_fees" class="form-label">Total Fees</label>
                            <input type="number" step="0.01" class="form-control" name="total_fees" value="{{ $student->total_fees }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="remarks" class="form-label">Remarks</label>
                            <textarea class="form-control" name="remarks">{{ $student->remarks }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Save Changes</button>
                        <a href="{{ route('admin.students.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
