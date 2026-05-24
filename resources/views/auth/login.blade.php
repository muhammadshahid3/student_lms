@extends('layouts.auth')

@section('title', 'Login - Student LMS')

@section('content')
    <div class="logo-section">
        <i class="fas fa-graduation-cap"></i>
        <h3 class="mt-2" style="color: #1f2937;">Student LMS portal</h3>
    </div>

    <h4 class="card-title text-center">Login</h4>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form action="{{ route('login') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                value="{{ old('email') }}" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                name="password" required>
        </div>

        <button type="submit" class="btn btn-primary">Login</button>
    </form>

    <hr>

    <p class="text-center mt-3">
        New student? <a href="{{ route('student.register') }}">Register here</a> or
        <a href="{{ route('admin.login') }}">Admin Login</a>
    </p>
@endsection
