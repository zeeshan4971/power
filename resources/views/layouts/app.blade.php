<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#1f3f93">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'PowerGuard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>
    <div class="page-loader" aria-hidden="true"><span></span></div>

    @unless($hideSidebar ?? false)
        @include('layouts.sidebar')
    @endunless

    @yield('content')

    @include('partials.onboarding')

    <div class="toast-container position-fixed top-0 end-0 p-3" id="appToastContainer" style="z-index: 20000"></div>

    <script>
        window.PowerGuardServerMessages = {{ Js::from([
        'success' => session('success'),
        'error' => session('error'),
        'warning' => session('warning'),
        'validation' => $errors->any() ? $errors->first() : null,
    ]) }};
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @auth
    <script>
        window.PowerGuardNotifications = {
            feedUrl: @json(route('notifications.feed')),
            permissionKey: 'powerguard-browser-notifications'
        };
    </script>
    @endauth
    <script src="{{ asset('app.js') }}" defer></script>
    @yield('scripts')
</body>
</html>
