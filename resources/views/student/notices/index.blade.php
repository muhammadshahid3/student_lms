@extends('student.layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="h3 mb-3">Notices</h1>

    @if($notices->isEmpty())
        <p class="text-muted">No notices.</p>
    @else
        <ul class="list-group">
            @foreach($notices as $notice)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong>{{ $notice->title }}</strong>
                        <div class="small text-muted">Published: {{ optional($notice->publish_date)->toDateString() }}</div>
                    </div>
                    <a href="{{ route('student.notices.show', $notice->id) }}" class="btn btn-sm btn-outline-primary">View</a>
                </li>
            @endforeach
        </ul>
        <div class="mt-3">{{ $notices->links() }}</div>
    @endif
</div>
@endsection
