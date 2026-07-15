@extends('layouts.app', ['hideSidebar' => true])

@section('content')
<div class="container-fluid main-wrapper">
    <div class="row min-vh-100">
        <div class="col-lg-6 left-panel">
            <img src="{{ asset('logo.png') }}" class="left-logo" alt="PowerGuard">
            <h1 class="hero-title">Protecting<br>your child's future</h1>
            <p class="hero-text">PowerGuard helps you stay connected with<br>your child's progress, goals, and early warnings.</p>
        </div>

        <div class="col-lg-6 right-panel">
            <div class="login-card">
                <img src="{{ asset('logo.png') }}" class="top-logo" alt="PowerGuard">
                <h2 class="login-title">Welcome Back</h2>
                <p class="subtitle">Parents and teachers use email. Students use their username.</p>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <label class="form-label" for="login">Email or student username</label>
                    <input
                        id="login"
                        name="login"
                        type="text"
                        class="form-control mb-3 @error('login') is-invalid @enderror"
                        placeholder="Email or username"
                        value="{{ old('login') }}"
                        autocomplete="username"
                        required
                        autofocus
                    >
                    @error('login')
                        <div class="invalid-feedback mb-2">{{ $message }}</div>
                    @enderror

                    <label class="form-label" for="password">Password</label>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        class="form-control mb-3 @error('password') is-invalid @enderror"
                        placeholder="Password"
                        autocomplete="current-password"
                        required
                    >

                    <div class="d-flex justify-content-between mb-4">
                        <label><input type="checkbox" name="remember" value="1"> Remember me</label>
                        <a href="#">Forgot Password?</a>
                    </div>

                    <button class="btn btn-signin" type="submit">Sign In</button>
                    <div class="divider"><span>OR</span></div>
                    <a href="{{ route('register') }}" class="btn-create">Create New Account</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
