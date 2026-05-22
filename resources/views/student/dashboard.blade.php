@extends('student.layouts.app')

@section('title', 'Student Dashboard')

@section('content')
    <div class="content-header">
        <h1><i class="fas fa-home"></i> Dashboard</h1>
        <p class="text-muted">Welcome, {{ auth()->user()->name }}</p>
    </div>

    <div class="row">
        <div class="col-md-3 col-sm-6">
            <div class="stat-card">
                <div class="number">{{ $enrolledCoursesCount }}</div>
                <div class="label">Enrolled Courses</div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="stat-card">
                <div class="number">{{ $totalMarksReceived }}</div>
                <div class="label">Marks Received</div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="stat-card">
                <div class="number">{{ $attendancePercentage }}%</div>
                <div class="label">Attendance</div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="stat-card">
                <div class="number">Rs. {{ number_format($pendingFees, 2) }}</div>
                <div class="label">Pending Fees</div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-book"></i> Your Courses</h5>
                    @if ($student->courses()->where('enrollment_status', 'active')->exists())
                        <div class="list-group">
                            @foreach ($student->courses()->where('enrollment_status', 'active')->limit(5)->get() as $course)
                                <a href="{{ route('student.courses.show', $course->id) }}" class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-1">{{ $course->name }}</h6>
                                        <small>{{ $course->code }}</small>
                                    </div>
                                    <p class="mb-1 text-muted">{{ $course->category->name }}</p>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted">No courses enrolled yet.</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-bell"></i> Latest Notices</h5>
                    @if (App\Models\Notice::where('is_active', true)->exists())
                        <div class="list-group">
                            @foreach (App\Models\Notice::where('is_active', true)->latest()->limit(5)->get() as $notice)
                                <a href="{{ route('student.notices.show', $notice->id) }}" class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-1">{{ $notice->title }}</h6>
                                        <small class="text-muted">{{ $notice->created_at->diffForHumans() }}</small>
                                    </div>
                                    <span class="badge bg-{{ $notice->type === 'urgent' ? 'danger' : 'info' }}">{{ ucfirst($notice->type) }}</span>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted">No notices yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-star"></i> Recent Marks</h5>
                    @if ($student->marks()->exists())
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Course</th>
                                        <th>Exam Type</th>
                                        <th>Marks</th>
                                        <th>Percentage</th>
                                        <th>Grade</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($student->marks()->latest()->limit(5)->get() as $mark)
                                        <tr>
                                            <td>{{ $mark->course->name }}</td>
                                            <td>{{ ucfirst($mark->exam_type) }}</td>
                                            <td>{{ $mark->obtained_marks }} / {{ $mark->total_marks }}</td>
                                            <td>{{ $mark->percentage }}%</td>
                                            <td><strong>{{ $mark->grade }}</strong></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted">No marks recorded yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
