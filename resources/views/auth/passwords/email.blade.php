@extends('layouts.auth')

@section('content')

<div class="d-flex justify-content-center align-items-center min-vh-100 bg-light">

    <div class="card border-0 shadow-sm rounded-4" style="max-width: 480px; width: 100%;">

        <div class="card-body p-5">

            {{-- Header --}}
            <div class="text-center mb-4">

                <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary bg-opacity-10 mb-3"
                     style="width: 60px; height: 60px;">
                    <i class="bi bi-envelope-paper text-primary fs-4"></i>
                </div>

                <h3 class="fw-bold mb-2">Reset Password</h3>

                <p class="text-muted small mb-0">
                    Enter your email and we’ll send you a reset link
                </p>

            </div>

            {{-- Status --}}
            @if (session('status'))
                <div class="alert alert-success rounded-3 py-2 small">
                    {{ session('status') }}
                </div>
            @endif

            {{-- Form --}}
            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="mb-3">

                    <label class="form-label fw-semibold">Email Address</label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="form-control form-control-lg @error('email') is-invalid @enderror"
                        placeholder="Enter registered email here...."
                        required
                        autofocus
                    >

                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                </div>

                <button type="submit" class="btn btn-success w-100 py-2 rounded-3">
                    Send Reset Link
                </button>

            </form>

            {{-- Back link --}}
            <div class="text-center mt-4">

                <a href="{{ route('login') }}" class="text-decoration-none small text-muted">
                    ← Back to Login
                </a>

            </div>

        </div>
    </div>

</div>

@endsection