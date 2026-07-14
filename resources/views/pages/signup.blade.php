@extends('layouts.app', ['hideSidebar' => true])

@section('content')
    <div class="container-fluid main-wrapper">
        <div class="row min-vh-100">

            <div class="col-lg-6 left-panel">
                <img src="{{ asset('logo.png') }}" alt="PowerGuard Logo" class="left-logo">

                <h1 class="hero-title">
                    Create your<br>
                    parent account
                </h1>

                <p class="hero-text">
                    Join PowerGuard to monitor your child's<br>
                    progress, goals, rewards, and early warnings.
                </p>
            </div>

            <div class="col-lg-6 right-panel">
                <div class="login-card">
                    <div class="card-inner">
                        <img src="{{ asset('logo.png') }}" alt="PowerGuard Logo" class="top-logo">

                        <h2 class="login-title">Create Account</h2>
                        <p class="subtitle">Register to start monitoring progress</p>

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <input type="text" name="name" class="form-control mb-3"
                                   placeholder="Full Name" value="{{ old('name') }}" required>

                            <input type="email" name="email" class="form-control mb-3"
                                   placeholder="Email Address" value="{{ old('email') }}" required>

                            <input type="password" name="password" class="form-control mb-3"
                                   placeholder="Password" required>

                            <input type="password" name="password_confirmation" class="form-control mb-4"
                                   placeholder="Confirm Password" required>

                            <button type="submit" class="btn btn-signin">Create Account</button>

                            <div class="divider">
                                <span>OR</span>
                            </div>

                            <a href="{{ route('register') }}" class="btn btn-create">
                                Already Have Account
                            </a>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
