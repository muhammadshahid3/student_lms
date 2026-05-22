@extends('student.layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="h3">{{ $notice->title }}</h1>
    <div class="card">
        <div class="card-body">
            <p class="text-muted">Published: {{ optional($notice->publish_date)->toDateString() }}</p>
            <div>{!! nl2br(e($notice->content)) !!}</div>
        </div>
    </div>
</div>
@endsection
