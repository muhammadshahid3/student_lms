<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Student Portal - Student LMS')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4f46e5;
            --secondary-color: #10b981;
            --danger-color: #ef4444;
            --sidebar-bg: #1f2937;
            --sidebar-text: #e5e7eb;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f3f4f6;
        }

        .sidebar {
            background: linear-gradient(135deg, var(--sidebar-bg) 0%, #111827 100%);
            color: var(--sidebar-text);
            min-height: 100vh;
            padding: 20px 0;
            position: fixed;
            left: 0;
            top: 0;
            width: 250px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            z-index: 999;
        }

        .sidebar-header {
            padding: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 20px;
        }

        .sidebar-header h2 {
            font-size: 20px;
            font-weight: 700;
            color: var(--primary-color);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .student-profile {
            padding: 15px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 20px;
        }

        .student-profile img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        .student-profile .name {
            font-weight: 600;
            color: white;
            font-size: 14px;
        }

        .student-profile .email {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.7);
        }

        .nav-item {
            padding: 0;
            margin-bottom: 5px;
        }

        .nav-link {
            color: var(--sidebar-text);
            padding: 12px 20px;
            border-left: 3px solid transparent;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            border-left-color: var(--primary-color);
            color: var(--primary-color);
        }

        .nav-link.active {
            background: rgba(79, 70, 229, 0.1);
            border-left-color: var(--primary-color);
            color: var(--primary-color);
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
        }

        .navbar {
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border-radius: 10px;
            margin-bottom: 25px;
        }

        .navbar-brand {
            color: var(--primary-color);
            font-weight: 700;
            font-size: 18px;
        }

        .content-header {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 25px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .content-header h1 {
            color: var(--sidebar-bg);
            font-weight: 700;
            font-size: 28px;
            margin-bottom: 10px;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }

        .card-title {
            color: var(--sidebar-bg);
            font-weight: 700;
            border-bottom: 2px solid var(--primary-color);
            padding-bottom: 15px;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color) 0%, #667eea 100%);
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #4338ca 0%, #4f46e5 100%);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(79, 70, 229, 0.3);
        }

        .table {
            background: white;
            border-radius: 8px;
            overflow: hidden;
        }

        .table thead {
            background: var(--sidebar-bg);
            color: white;
        }

        .table th {
            border: none;
            font-weight: 600;
            padding: 15px;
        }

        .table td {
            border: none;
            padding: 15px;
            border-bottom: 1px solid #e5e7eb;
        }

        .alert {
            border-radius: 8px;
            border: none;
            margin-bottom: 20px;
        }

        .form-control {
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            padding: 10px 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(79, 70, 229, 0.15);
        }

        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
            border-left: 4px solid var(--primary-color);
        }

        .stat-card .number {
            font-size: 32px;
            font-weight: 700;
            color: var(--primary-color);
        }

        .stat-card .label {
            color: #6b7280;
            font-size: 14px;
            margin-top: 5px;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 60px;
                padding: 15px 0;
            }

            .sidebar-header h2 {
                font-size: 14px;
                justify-content: center;
            }

            .sidebar-header h2 span {
                display: none;
            }

            .student-profile {
                display: none;
            }

            .nav-link {
                padding: 12px;
                justify-content: center;
            }

            .nav-link span {
                display: none;
            }

            .main-content {
                margin-left: 60px;
            }
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <h2><i class="fas fa-graduation-cap"></i> <span>LMS Student</span></h2>
        </div>
        
        @auth
            <div class="student-profile">
                <img src="{{ auth()->user()->student->avatar ? asset('storage/' . auth()->user()->student->avatar) : 'https://via.placeholder.com/50' }}" alt="Avatar">
                <div class="name">{{ auth()->user()->name }}</div>
                <div class="email">{{ auth()->user()->email }}</div>
            </div>
        @endauth

        <nav class="nav flex-column">
            <a class="nav-link {{ Route::is('student.dashboard') ? 'active' : '' }}" href="{{ route('student.dashboard') }}">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>
            <a class="nav-link {{ Route::is('student.profile.*') ? 'active' : '' }}" href="{{ route('student.profile.show') }}">
                <i class="fas fa-user"></i>
                <span>Profile</span>
            </a>
            <a class="nav-link {{ Route::is('student.courses.*') ? 'active' : '' }}" href="{{ route('student.courses.index') }}">
                <i class="fas fa-book"></i>
                <span>Courses</span>
            </a>
            <a class="nav-link {{ Route::is('student.marks.*') ? 'active' : '' }}" href="{{ route('student.marks.index') }}">
                <i class="fas fa-star"></i>
                <span>Marks</span>
            </a>
            <a class="nav-link {{ Route::is('student.attendance.*') ? 'active' : '' }}" href="{{ route('student.attendance.index') }}">
                <i class="fas fa-clipboard-list"></i>
                <span>Attendance</span>
            </a>
            <a class="nav-link {{ Route::is('student.assignments.*') ? 'active' : '' }}" href="{{ route('student.assignments.index') }}">
                <i class="fas fa-tasks"></i>
                <span>Assignments</span>
            </a>
            <a class="nav-link {{ Route::is('student.notices.*') ? 'active' : '' }}" href="{{ route('student.notices.index') }}">
                <i class="fas fa-bell"></i>
                <span>Notices</span>
            </a>
            <a class="nav-link {{ Route::is('student.fees.*') ? 'active' : '' }}" href="{{ route('student.fees.index') }}">
                <i class="fas fa-money-bill"></i>
                <span>Fees</span>
            </a>
            <hr style="border-color: rgba(255, 255, 255, 0.1); margin: 20px 0;">
            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </nav>
    </div>

    <div class="main-content">
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><i class="fas fa-exclamation-circle"></i> Error!</strong>
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
