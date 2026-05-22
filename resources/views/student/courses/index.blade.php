@extends('student.layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Courses</h1>
    </div>

    <div class="row">
        @forelse($courses as $course)
            <div class="col-md-6 mb-3">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $course->name }} <small class="text-muted">({{ $course->code }})</small></h5>
                        <p class="card-text">{{ \Illuminate\Support\Str::limit($course->description, 150) }}</p>
                        <p class="mb-1"><strong>Credits:</strong> {{ $course->credits }}</p>
                        <p class="mb-1"><strong>Fee:</strong> {{ number_format($course->fee) }}</p>
                        <a href="{{ route('student.courses.show', $course->id) }}" class="btn btn-primary btn-sm">View</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">No courses available.</div>
            </div>
        @endforelse
    </div>

    <div class="mt-3">
        {{ $courses->links() }}
    </div>
</div>
@endsection
