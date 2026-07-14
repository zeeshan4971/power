@php
    if (!function_exists('pg_active')) {
        function pg_active($key, $active) {
            return $key === $active ? 'active' : '';
        }
    }

    $sidebarRole = auth()->user()?->role;
@endphp

<aside class="sidebar" data-tour="sidebar">
    <div class="sidebar-logo">
        <img src="{{ asset('logo.png') }}" class="logo" alt="PowerGuard">
    </div>

    <nav class="menu">
        @if ($sidebarRole === 'teacher')
            <a href="{{ route('dashboard') }}" class="{{ pg_active('teacher-dashboard', $activePage ?? '') }}" data-tour="home-link">
                <span class="menu-icon" aria-hidden="true">🏠</span><span class="menu-text">Dashboard</span>
            </a>
            <a href="{{ route('dashboard') }}#students" data-tour="teacher-students-link">
                <span class="menu-icon" aria-hidden="true">👨‍🎓</span><span class="menu-text">Students</span>
            </a>
            <a href="{{ route('dashboard') }}#checkins" data-tour="teacher-checkins-link">
                <span class="menu-icon" aria-hidden="true">📝</span><span class="menu-text">Check-ins</span>
            </a>
            <a href="{{ route('dashboard') }}#goals" data-tour="goals-link">
                <span class="menu-icon" aria-hidden="true">🎯</span><span class="menu-text">Goals Progress</span>
            </a>
            <a href="{{ route('teacher-feedback') }}" class="{{ pg_active('teacher-feedback', $activePage ?? '') }}" data-tour="teacher-link">
                <span class="menu-icon" aria-hidden="true">💬</span><span class="menu-text">Feedback History</span>
            </a>
            <a href="{{ route('dashboard') }}#notifications" data-tour="notifications-link">
                <span class="menu-icon" aria-hidden="true">🔔</span><span class="menu-text">Notifications</span>
            </a>
            <a href="{{ route('profile.edit') }}">
                <span class="menu-icon" aria-hidden="true">⚙️</span><span class="menu-text">Profile</span>
            </a>
        @else
            <a href="{{ route('dashboard') }}" class="{{ pg_active('home', $activePage ?? '') }}" data-tour="home-link">
                <span class="menu-icon" aria-hidden="true">🏠</span><span class="menu-text">Home</span>
            </a>
            <a href="{{ route('goals.index') }}" class="{{ pg_active('goals', $activePage ?? '') }}" data-tour="goals-link">
                <span class="menu-icon" aria-hidden="true">🎯</span><span class="menu-text">Goals</span>
            </a>
            <a href="{{ route('rewards.index') }}" class="{{ pg_active('rewards', $activePage ?? '') }}" data-tour="rewards-link">
                <span class="menu-icon" aria-hidden="true">🎁</span><span class="menu-text">Rewards</span>
            </a>
            <a href="{{ route('alerts') }}" class="{{ pg_active('alerts', $activePage ?? '') }}" data-tour="alerts-link">
                <span class="menu-icon" aria-hidden="true">🚨</span><span class="menu-text">Alerts</span>
            </a>
            <a href="{{ route('teacher-feedback') }}" class="{{ pg_active('teacher-feedback', $activePage ?? '') }}" data-tour="teacher-link">
                <span class="menu-icon" aria-hidden="true">👩‍🏫</span><span class="menu-text">Teacher Feedback</span>
            </a>
            <a href="{{ route('reports') }}" class="{{ pg_active('reports', $activePage ?? '') }}" data-tour="reports-link">
                <span class="menu-icon" aria-hidden="true">📊</span><span class="menu-text">Reports</span>
            </a>

            @if ($sidebarRole === 'parent')
                <a href="{{ route('manage-access') }}" class="{{ pg_active('manage-access', $activePage ?? '') }}" data-tour="manage-link">
                    <span class="menu-icon" aria-hidden="true">🧑‍💻</span><span class="menu-text">Manage Access</span>
                </a>
            @endif
        @endif

        <form method="POST" action="{{ route('onboarding.restart') }}" class="sidebar-tour-form">
            @csrf
            <button type="submit" class="sidebar-tour-button">
                <span class="menu-icon" aria-hidden="true">✨</span><span class="menu-text">Take Guided Tour</span>
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="sidebar-logout-form">
            @csrf
            <button type="submit" class="sidebar-logout-button">
                <span class="menu-icon" aria-hidden="true">↪</span><span class="menu-text">Logout</span>
            </button>
        </form>
    </nav>
</aside>
