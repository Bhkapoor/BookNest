@extends('layouts.user')

@section('content')

@if(session('success'))
    <div id="flash-message" class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif
<div class="container-fluid">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body p-5">

                   <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

    <div>
        <h3 class="fw-bold mb-1">My Profile</h3>
        <p class="text-muted mb-0">
            Manage your personal information and account details.
        </p>
    </div>

    <div class="d-flex gap-2">

<button type="button" class="btn btn-outline-success rounded-pill px-4"
        data-bs-toggle="modal"
        data-bs-target="#changePasswordModal">
    <i class="bi bi-lock-fill me-2"></i>
    Change Password
</button>

 <button type="button" class="btn btn-success rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#editProfileModal">
    <i class="bi bi-pencil-square me-2"></i>
    Edit Profile
</button>

    </div>

</div>
                    <hr>

                    <div class="row align-items-center mt-4">

                        <div class="col-md-3 text-center mb-4 mb-md-0">

                            <div class="profile-avatar mx-auto">
                                {{ strtoupper(substr(Auth::user()->name ?? 'S',0,1)) }}
                            </div>

                        </div>

                        <div class="col-md-9">

                            <div class="row g-4">

                                <div class="col-md-6">
                                    <label class="text-muted small">Full Name</label>
                                    <h6 class="fw-bold">
                                        {{ Auth::user()->name ?? 'Student Name' }}
                                    </h6>
                                </div>

                                <div class="col-md-6">
                                    <label class="text-muted small">Email Address</label>
                                    <h6 class="fw-bold">
                                        {{ Auth::user()->email ?? 'email@example.com' }}
                                    </h6>
                                </div>

                                <div class="col-md-6">
                                    <label class="text-muted small">Course</label>
                                    <h6 class="fw-bold">
                                        {{ Auth::user()->course ?? 'B.Tech CSE' }}
                                    </h6>
                                </div>

                                <div class="col-md-6">
                                    <label class="text-muted small">Current Semester</label>
                                    <h6 class="fw-bold">
                                        Semester {{ Auth::user()->semester ?? '3' }}
                                    </h6>
                                </div>

                                <div class="col-md-6">
                                    <label class="text-muted small">Phone Number</label>
                                    <h6 class="fw-bold">
                                        {{ Auth::user()->phone ?? '+91 XXXXX XXXXX' }}
                                    </h6>
                                </div>

                                <div class="col-md-6">
                                    <label class="text-muted small">Account Status</label>

                                    <span class="badge bg-success rounded-pill px-3 py-2">
                                        Active
                                    </span>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- Verification Card --}}

    <div class="row justify-content-center mt-4">

        <div class="col-lg-8">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body p-4">

                    <div class="d-flex align-items-center gap-3">

                        <div class="verification-icon">
                            <i class="bi bi-patch-check-fill"></i>
                        </div>

                        <div>
                            <h6 class="fw-bold mb-1">
                                Verified Campus Student
                            </h6>

                            <p class="mb-0 text-muted">
                                Your account is verified. You can list books,
                                send requests, receive requests and access PYQ papers.
                            </p>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

{{-- modal --}}
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 rounded-4">

            <div class="modal-header border-0 p-4 pb-0">
                <div>
                    <h5 class="modal-title fw-bold" id="editProfileModalLabel">Edit Profile</h5>
                    <p class="text-muted small mb-0">Update your basic student information.</p>
                </div>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('profile.update') }}" method="POST">
                @csrf

                <div class="modal-body p-4">

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Full Name</label>
                            <input type="text" name="name" class="form-control rounded-3"
                                   value="{{ Auth::user()->name ?? '' }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Email Address</label>
                            <input type="email" name="email" class="form-control rounded-3"
                                   value="{{ Auth::user()->email ?? '' }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Course</label>
                            <input type="text" name="course" class="form-control rounded-3"
                                   value="{{ Auth::user()->course ?? '' }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Current Semester</label>
                            <select name="semester" class="form-select rounded-3">
                                <option value="">Select Semester</option>
                                @for($i = 1; $i <= 8; $i++)
                                    <option value="{{ $i }}" {{ (Auth::user()->semester ?? '') == $i ? 'selected' : '' }}>
                                        Semester {{ $i }}
                                    </option>
                                @endfor
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Phone Number</label>
                            <input type="text" name="phone" class="form-control rounded-3"
                                   value="{{ Auth::user()->phone ?? '' }}">
                        </div>

                    </div>

                </div>

                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <button type="submit" class="btn btn-success rounded-pill px-4">
                        Save Changes
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

{{-- change password modal --}}
<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4">

            <div class="modal-header border-0 p-4 pb-0">
                <div>
                    <h5 class="modal-title fw-bold">Change Password</h5>
                    <p class="text-muted small mb-0">Update your login password securely.</p>
                </div>

                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('profile.password.update') }}" method="POST">
                @csrf

                <div class="modal-body p-4">

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Current Password</label>
                        <input type="password" name="current_password" class="form-control rounded-3">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">New Password</label>
                        <input type="password" name="password" class="form-control rounded-3">
                    </div>

                    <div>
                        <label class="form-label fw-semibold">Confirm New Password</label>
                        <input type="password" name="password_confirmation" class="form-control rounded-3">
                    </div>

                </div>

                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <button type="submit" class="btn btn-success rounded-pill px-4">
                        Update Password
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection