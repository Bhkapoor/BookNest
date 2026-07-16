@extends('layouts.auth')

@section('content')
<div class="d-flex justify-content-center align-items-center min-vh-100 bg-light">

    <div class="card border-0 shadow-sm rounded-4" style="max-width: 420px; width: 100%;">
        
        <div class="card-body p-4">

            <h4 class="fw-bold text-center mb-4">
                Reset Password
            </h4>

            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                {{-- Email --}}
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input id="email"
                           type="email"
                           class="form-control @error('email') is-invalid @enderror"
                           name="email"
                           value="{{ $email ?? old('email') }}"
                           required>

                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="mb-3">
                    <label class="form-label">New Password</label>
                    <input id="password"
                           type="password"
                           class="form-control @error('password') is-invalid @enderror"
                           name="password"
                           required>

                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Confirm --}}
                <div class="mb-3">
                    <label class="form-label">Confirm Password</label>
                    <input id="password-confirm"
                           type="password"
                           class="form-control"
                           name="password_confirmation"
                           required>
                </div>

                <button type="submit" class="btn btn-success w-100 rounded-3">
                    Reset Password
                </button>

            </form>
        </div>
    </div>

</div>
@endsection