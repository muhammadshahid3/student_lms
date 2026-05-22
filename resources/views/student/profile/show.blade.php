@extends('student.layouts.app')

@section('title', 'My Profile')

@section('content')
    <div class="content-header">
        <h1><i class="fas fa-user-circle"></i> My Profile</h1>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <img src="{{ auth()->user()->student->avatar ? asset('storage/' . auth()->user()->student->avatar) : 'https://via.placeholder.com/150' }}" alt="Profile" class="img-fluid rounded-circle mb-3" style="max-width: 150px;">
                    <h5>{{ auth()->user()->name }}</h5>
                    <p class="text-muted">{{ $student->roll_number }}</p>
                    <a href="{{ route('student.profile.edit') }}" class="btn btn-primary btn-sm">Edit Profile</a>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Personal Information</h5>
                    <table class="table">
                        <tr>
                            <th>Full Name</th>
                            <td>{{ auth()->user()->name }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ auth()->user()->email }}</td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>{{ $student->phone }}</td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>{{ $student->address }}</td>
                        </tr>
                        <tr>
                            <th>Date of Birth</th>
                            <td>{{ $student->date_of_birth ? $student->date_of_birth->format('d M Y') : 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Roll Number</th>
                            <td>{{ $student->roll_number }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if ($student->status === 'active')
                                    <span class="badge bg-success">Active</span>
                                @elseif ($student->status === 'blocked')
                                    <span class="badge bg-danger">Blocked</span>
                                @else
                                    <span class="badge bg-warning">Inactive</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Approval Status</th>
                            <td>
                                @if ($student->is_approved)
                                    <span class="badge bg-success">Approved</span>
                                @else
                                    <span class="badge bg-warning">Pending</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
