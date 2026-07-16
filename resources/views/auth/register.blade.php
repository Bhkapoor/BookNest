@extends('layouts.auth')

@section('content')
<div class="min-vh-100" style="background: linear-gradient(135deg, #f8f6f1 0%, #eef5f1 100%);">

    {{-- Simple Navbar --}}
    <nav class="navbar navbar-expand-lg bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('home') }}" style="color:#1A1A2E;">
                📚 BookNest
            </a>

            <a href="{{ url('/') }}" class="btn btn-outline-success rounded-pill px-4">
              <i class="bi bi-arrow-left me-2"></i>  Back to Home
            </a>
        </div>
    </nav>

<div class="container py-5">
    <div class="row justify-content-center align-items-center">
        <div class="col-lg-7 col-md-9">

            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header text-center text-white py-4 border-0" style="background:#2D6A4F;">
                    <h3 class="fw-bold mb-1">📚 Join BookNest</h3>
                    <p class="mb-0 small">Create your campus book exchange account</p>
                </div>

                <div class="card-body p-4 p-md-5">
                    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row g-3">

                            <div class="col-md-6">
                                <label for="name" class="form-label fw-semibold">Name</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">
                                        <i class="bi bi-person"></i>
                                    </span>
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror"
                                        name="name"
                                        value="{{ old('name') }}"
                                        placeholder="Enter your name..."
                                        required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="email" class="form-label fw-semibold">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">
                                        <i class="bi bi-envelope"></i>
                                    </span>
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        name="email"
                                        value="{{ old('email') }}"
                                         placeholder="Enter your email..."
                                        required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="phoneNumber" class="form-label fw-semibold">Phone Number</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">
                                        <i class="bi bi-telephone"></i>
                                    </span>
                                    <input id="phone" type="text"
                                        class="form-control @error('phone') is-invalid @enderror"
                                        name="phone"
                                        value="{{ old('phone') }}"
                                        required>

                                    @error('phone')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="course" class="form-label fw-semibold">Course</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">
                                        <i class="bi bi-mortarboard"></i>
                                    </span>
                                    <input id="course" type="text"
                                        class="form-control @error('course') is-invalid @enderror"
                                        name="course"
                                        value="{{ old('course') }}"
                                        placeholder="Enter course name..."
                                        required>

                                    @error('course')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="semester" class="form-label fw-semibold">Semester</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">
                                        <i class="bi bi-calendar3"></i>
                                    </span>
                                    <select id="semester"
                                        class="form-select @error('semester') is-invalid @enderror"
                                        name="semester"
                                        required>
                                        <option value="">Select Semester</option>
                                        <option value="1" {{ old('semester') == ' 1' ? 'selected' : '' }}>Sem 1</option>
                                        <option value="2" {{ old('semester') == ' 2' ? 'selected' : '' }}>Sem 2</option>
                                        <option value="3" {{ old('semester') == ' 3' ? 'selected' : '' }}>Sem 3</option>
                                        <option value="4" {{ old('semester') == ' 4' ? 'selected' : '' }}>Sem 4</option>
                                        <option value="5" {{ old('semester') == ' 5' ? 'selected' : '' }}>Sem 5</option>
                                        <option value="6" {{ old('semester') == ' 6' ? 'selected' : '' }}>Sem 6</option>
                                    </select>

                                    @error('semester')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="registrationId" class="form-label fw-semibold">Registration ID</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">
                                        <i class="bi bi-person-badge"></i>
                                    </span>
                                    <input id="registration_id" type="text"
                                        class="form-control @error('registrationId') is-invalid @enderror"
                                        name="registration_id"
                                        value="{{ old('registrationId') }}"
                                        placeholder="College Registration ID"
                                        required>

                                    @error('registration_id')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="password" class="form-label fw-semibold">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">
                                        <i class="bi bi-lock"></i>
                                    </span>
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="password-confirm" class="form-label fw-semibold">Confirm Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">
                                        <i class="bi bi-shield-lock"></i>
                                    </span>
                                    <input id="password-confirm" type="password"
                                        class="form-control"
                                        name="password_confirmation"
                                        required autocomplete="new-password">
                                </div>
                            </div>

                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn text-white fw-bold py-2 rounded-pill" style="background:#2D6A4F;">
                                Create My Account
                            </button>
                        </div>

                        <div class="text-center mt-3">
                            <small class="text-muted">
                                Already have an account?
                                <a href="{{ route('login') }}" class="fw-semibold text-decoration-none" style="color:#2D6A4F;">
                                    Login here
                                </a>
                            </small>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
</div>
@endsection