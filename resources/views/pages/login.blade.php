@extends('layouts.app', ['hideSidebar' => true])

@section('content')
<div class="container-fluid main-wrapper">
    <div class="row min-vh-100">

      <div class="col-lg-6 left-panel">
        <img src="{{ asset('logo.png') }}" alt="PowerGuard Logo" class="left-logo">

        <h1 class="hero-title">
          Protecting<br>
          your child's future
        </h1>

        <p class="hero-text">
          PowerGuard helps you stay connected with<br>
          your child's progress, goals, and early warnings.
        </p>
      </div>

      <div class="col-lg-6 right-panel">
        <div class="login-card">
          <div class="card-inner">
            <img src="{{ asset('logo.png') }}" alt="PowerGuard Logo" class="top-logo">

            <h2 class="login-title">Welcome Back</h2>
            <p class="subtitle">Sign in to monitor your child's progress</p>

            <form>
              <div class="input-group mb-4">
                <span class="input-group-text">Email / User</span>
                <input type="email" class="form-control" value="parent@example.com">
              </div>

              <input type="password" class="form-control mb-3" value="123456789">

              <div class="remember-row">
                <label class="form-check-label d-flex align-items-center">
                  <input class="form-check-input" type="checkbox">
                  Remember me
                </label>

                <a href="#" class="forgot-link">Forgot Password?</a>
              </div>

              <button type="submit" class="btn btn-signin">Sign In</button>

              <div class="divider">
                <span>OR</span>
              </div>

              <a href="{{ route('register') }}">
                  <button type="button" class="btn btn-create">
                      Create New Account
                  </button>
              </a>

            </form>
          </div>
        </div>
      </div>

    </div>
  </div>
@endsection
