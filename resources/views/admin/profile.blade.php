@extends('layouts.admin')

@section('page-title', 'Admin Dashboard')

@section('content')

    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4">

            <div class="row align-items-center">

                <div class="col-md-auto text-center">
                    <div class="profile-avatar">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                </div>

                <div class="col">

                    <h2 class="fw-bold mb-1">
                        {{ Auth::user()->name }}
                    </h2>

                    <span class="badge bg-success px-3 py-2">
                        Administrator
                    </span>

                    <p class="text-muted mt-2 mb-0">
                        Manage your account settings and platform information.
                    </p>

                </div>

                <div class="col-md-auto mt-3 mt-md-0">

                    <a href="#" class="btn btn-outline-success rounded-pill px-4" data-bs-toggle="modal"
                        data-bs-target="#changePasswordModal">
                        <i class="bi bi-key"></i>
                        Change Password
                    </a>

                    <a href="#" class="btn btn-success rounded-pill px-4" data-bs-toggle="modal"
                        data-bs-target="#editProfileModal">
                        <i class="bi bi-pencil-square"></i>
                        Edit Profile
                    </a>

                </div>

            </div>

        </div>
    </div>

    <div class="row g-4">

        <div class="col-lg-6">

            <div class="card border-0 shadow-sm rounded-4 h-100">

                <div class="card-header bg-white border-0 pt-4">
                    <h5 class="fw-bold">
                        Personal Information
                    </h5>
                </div>

                <div class="card-body">

                    <div class="mb-4">
                        <label class="text-muted">
                            Full Name
                        </label>

                        <h6 class="fw-bold">
                            {{ Auth::user()->name }}
                        </h6>
                    </div>

                    <div class="mb-4">
                        <label class="text-muted">
                            Email Address
                        </label>

                        <h6 class="fw-bold">
                            {{ Auth::user()->email }}
                        </h6>
                    </div>

                </div>

            </div>

        </div>

        <div class="col-lg-6">

            <div class="card border-0 shadow-sm rounded-4 h-100">

                <div class="card-header bg-white border-0 pt-4">
                    <h5 class="fw-bold">
                        Account Information
                    </h5>
                </div>

                <div class="card-body">

                    <div class="mb-4">
                        <label class="text-muted">
                            Role
                        </label>

                        <h6 class="fw-bold">
                            {{ ucfirst(Auth::user()->role) }}
                        </h6>
                    </div>

                    <div class="mb-4">
                        <label class="text-muted">
                            Member Since
                        </label>

                        <h6 class="fw-bold">
                            {{ Auth::user()->created_at->format('d M Y') }}
                        </h6>
                    </div>

                    <div>
                        <label class="text-muted">
                            Last Updated
                        </label>

                        <h6 class="fw-bold">
                            {{ Auth::user()->updated_at->format('d M Y') }}
                        </h6>
                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- modal --}}
    <div class="modal fade" id="editProfileModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4">

            <div class="modal-header border-0 pb-0">
                <div>
                    <h5 class="fw-bold mb-1">
                        Edit Profile
                    </h5>
                    <p class="text-muted small mb-0">
                        Update your administrator account details.
                    </p>
                </div>

                <button type="button"
                    class="btn-close"
                    data-bs-dismiss="modal">
                </button>
            </div>

            <form action="{{ route('profile.update') }}" method="POST">
                @csrf

                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            Full Name
                        </label>

                        <input type="text"
                            name="name"
                            class="form-control rounded-3"
                            value="{{ Auth::user()->name }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            Email Address
                        </label>

                        <input type="email"
                            name="email"
                            class="form-control rounded-3"
                            value="{{ Auth::user()->email }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            Role
                        </label>

                        <input type="text"
                            class="form-control rounded-3 bg-light"
                            value="Administrator"
                            readonly>
                    </div>

                </div>

                <div class="modal-footer border-0">

                    <button type="button"
                        class="btn btn-light rounded-pill px-4"
                        data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <button type="submit"
                        class="btn btn-success rounded-pill px-4">
                        Save Changes
                    </button>

                </div>

            </form>

        </div>
    </div>
</div>

    {{-- change password modal --}}
    <div class="modal fade" id="changePasswordModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4">

            <div class="modal-header border-0 pb-0">

                <div>
                    <h5 class="fw-bold mb-1">
                        Change Password
                    </h5>

                    <p class="text-muted small mb-0">
                        Keep your administrator account secure.
                    </p>
                </div>

                <button type="button"
                    class="btn-close"
                    data-bs-dismiss="modal">
                </button>

            </div>

            <form action="{{ route('profile.password.update') }}"
                method="POST">

                @csrf

                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            Current Password
                        </label>

                        <input type="password"
                            name="current_password"
                            class="form-control rounded-3">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            New Password
                        </label>

                        <input type="password"
                            name="password"
                            class="form-control rounded-3">
                    </div>

                    <div>
                        <label class="form-label fw-semibold">
                            Confirm Password
                        </label>

                        <input type="password"
                            name="password_confirmation"
                            class="form-control rounded-3">
                    </div>

                </div>

                <div class="modal-footer border-0">

                    <button type="button"
                        class="btn btn-light rounded-pill px-4"
                        data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <button type="submit"
                        class="btn btn-success rounded-pill px-4">
                        Update Password
                    </button>

                </div>

            </form>

        </div>
    </div>
</div>
@endsection
