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
               <i class="bi bi-arrow-left me-2"></i> Back to Home
            </a>
        </div>
    </nav>

<div class="container py-5">
    <div class="row justify-content-center align-items-center">
        <div class="col-lg-5 col-md-7">


        <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

            <div class="card-header text-center text-white py-4 border-0"
                style="background:#2D6A4F;">
                <h3 class="fw-bold mb-1">📚 Welcome Back</h3>
                <p class="mb-0 small">Login to your BookNest account</p>
            </div>

            <div class="card-body p-4 p-md-5">

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="email" class="form-label fw-semibold">
                            Email Address
                        </label>

                        <div class="input-group">
                            <span class="input-group-text bg-light">
                                <i class="bi bi-envelope"></i>
                            </span>

                            <input id="email"
                                type="email"
                                class="form-control @error('email') is-invalid @enderror"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autocomplete="email"
                                autofocus>

                            @error('email')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label fw-semibold">
                            Password
                        </label>

                        <div class="input-group">
                            <span class="input-group-text bg-light">
                                <i class="bi bi-lock"></i>
                            </span>

                            <input id="password"
                                type="password"
                                class="form-control @error('password') is-invalid @enderror"
                                name="password"
                                required
                                autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4">

                        <div class="form-check">
                            <input class="form-check-input"
                                type="checkbox"
                                name="remember"
                                id="remember"
                                {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                Remember Me
                            </label>
                        </div>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}"
                               class="text-decoration-none fw-semibold"
                               style="color:#2D6A4F;">
                                Forgot Password?
                            </a>
                        @endif

                    </div>

                    <div class="d-grid">
                        <button type="submit"
                            class="btn text-white fw-bold py-2 rounded-pill"
                            style="background:#2D6A4F;">
                            Login
                        </button>
                    </div>

                    <div class="text-center mt-4">
                        <small class="text-muted">
                            Don't have an account?

                            <a href="{{ route('register') }}"
                               class="fw-semibold text-decoration-none"
                               style="color:#2D6A4F;">
                                Register Here
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
