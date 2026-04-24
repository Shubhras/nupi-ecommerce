@extends('layouts.admin')

@section('content')
    <div class="admin-login-wrapper">
        <div class="admin-login-card">
            <div class="text-center">
                <!-- Use logo from frontend -->
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="admin-login-logo">
            </div>

            <h3 class="admin-login-title">Admin Login</h3>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <input id="email" type="email" class="form-control admin-input @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                        placeholder="Email Address">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <input id="password" type="password"
                        class="form-control admin-input @error('password') is-invalid @enderror" name="password" required
                        autocomplete="current-password" placeholder="Password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-admin-login">
                    Login to Dashboard
                </button>
            </form>
        </div>
    </div>
@endsection