@extends('layouts.auth')

@section('title', 'Admin Login - Student LMS')

@section('content')
    <div class="logo-section">
        <i class="fas fa-shield-alt"></i>
        <h3 class="mt-2" style="color: #1f2937;">Admin Panel</h3>
    </div>

    <h4 class="card-title text-center">Admin Login</h4>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form action="{{ route('admin.login.post') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
        </div>

        <button type="submit" class="btn btn-primary">Login</button>
    </form>

    <hr>

    <p class="text-center mt-3">
        <a href="{{ route('login') }}">Student Login</a> | <a href="{{ route('student.register') }}">Register</a>
    </p>
@endsection
