@extends('admin.layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="content-header">
        <h1><i class="fas fa-chart-line"></i> Dashboard</h1>
        <p class="text-muted">Welcome to Admin Panel</p>
    </div>

    <div class="row">
        <div class="col-md-3 col-sm-6">
            <div class="stat-card">
                <div class="number">{{ $totalStudents }}</div>
                <div class="label">Total Students</div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="stat-card">
                <div class="number">{{ $approvedStudents }}</div>
                <div class="label">Approved Students</div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="stat-card">
                <div class="number">{{ $pendingApproval }}</div>
                <div class="label">Pending Approval</div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="stat-card">
                <div class="number">{{ $blockedStudents }}</div>
                <div class="label">Blocked Students</div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3 col-sm-6">
            <div class="stat-card">
                <div class="number">{{ $totalCourses }}</div>
                <div class="label">Total Courses</div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="stat-card">
                <div class="number">{{ $totalCategories }}</div>
                <div class="label">Categories</div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="stat-card">
                <div class="number">Rs. {{ number_format($paidFees, 2) }}</div>
                <div class="label">Paid Fees</div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="stat-card">
                <div class="number">Rs. {{ number_format($unpaidFees, 2) }}</div>
                <div class="label">Unpaid Fees</div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-users"></i> Recent Students</h5>
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recentStudents as $student)
                                    <tr>
                                        <td>{{ $student->user->name }}</td>
                                        <td>{{ $student->user->email }}</td>
                                        <td>
                                            @if ($student->is_approved)
                                                <span class="badge bg-success">Approved</span>
                                            @else
                                                <span class="badge bg-warning">Pending</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-book"></i> Recent Courses</h5>
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Course Name</th>
                                    <th>Code</th>
                                    <th>Category</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recentCourses as $course)
                                    <tr>
                                        <td>{{ $course->name }}</td>
                                        <td>{{ $course->code }}</td>
                                        <td>{{ $course->category->name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
