<aside class="sidebar">
    <div class="sidebar-logo">
        <img src="{{ asset('logo.png') }}" alt="PowerGuard Logo" class="logo">
    </div>

    <nav class="menu">
        <a href="{{ route('dashboard') }}"
           class="{{ ($activePage ?? '') === 'home' ? 'active' : '' }}">
            <span class="menu-icon">🏠</span>
            <span class="menu-text">Home</span>
        </a>

        <a href="{{ route('goals') }}"
           class="{{ ($activePage ?? '') === 'goals' ? 'active' : '' }}">
            <span class="menu-icon">🎯</span>
            <span class="menu-text">Goals</span>
        </a>

        <a href="{{ route('rewards') }}"
           class="{{ ($activePage ?? '') === 'rewards' ? 'active' : '' }}">
            <span class="menu-icon">🎁</span>
            <span class="menu-text">Rewards</span>
        </a>

        <a href="{{ route('alerts') }}"
           class="{{ ($activePage ?? '') === 'alerts' ? 'active' : '' }}">
            <span class="menu-icon">🚨</span>
            <span class="menu-text">Alerts</span>
        </a>

        <a href="{{ route('teacher-feedback') }}"
           class="{{ ($activePage ?? '') === 'teacher-feedback' ? 'active' : '' }}">
            <span class="menu-icon">👩‍🏫</span>
            <span class="menu-text">Teacher Feedback</span>
        </a>

        <a href="{{ route('reports') }}"
           class="{{ ($activePage ?? '') === 'reports' ? 'active' : '' }}">
            <span class="menu-icon">📊</span>
            <span class="menu-text">Reports</span>
        </a>

        <a href="{{ route('manage-access') }}"
           class="{{ ($activePage ?? '') === 'manage-access' ? 'active' : '' }}">
            <span class="menu-icon">🧑‍💻</span>
            <span class="menu-text">Manage Access</span>
        </a>
    </nav>
</aside>
