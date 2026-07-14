@php
    $currentUser = auth()->user();
    $avatarUrl = $currentUser?->avatar_url;
    $topNotifications = $currentUser?->appNotifications()->latest()->take(8)->get() ?? collect();
    $unreadCount = $currentUser?->appNotifications()->whereNull('read_at')->count() ?? 0;
@endphp
<header class="topbar">
    <h1 data-tour="page-title">{{ $title }}</h1>
    @auth
    <div class="d-flex align-items-center gap-3">
        <div class="dropdown">
            <button class="notification-button" data-tour="notifications" data-tour="notifications" data-bs-toggle="dropdown" aria-label="Notifications" id="notificationBell">
                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9M10 21h4"/></svg>
                <span class="notification-badge {{ $unreadCount ? '' : 'd-none' }}" id="notificationBadge">{{ $unreadCount }}</span>
            </button>
            <div class="dropdown-menu dropdown-menu-end notification-menu">
                <div class="notification-heading d-flex justify-content-between align-items-center">
                    <span>Notifications</span>
                    <form method="POST" action="{{ route('notifications.read-all') }}">@csrf
                        <button class="btn btn-link btn-sm p-0 text-decoration-none" type="submit">Mark all read</button>
                    </form>
                </div>
                <button type="button" class="enable-browser-notifications" id="enableBrowserNotifications">
                    Enable Chrome Notifications
                </button>
                <div id="notificationList">
                    @forelse($topNotifications as $notice)
                        <a class="notification-item {{ $notice->read_at ? '' : 'unread' }}" href="{{ route('notifications.open', $notice) }}" data-notification-id="{{ $notice->id }}">
                            <span class="notification-dot"></span>
                            <span><strong>{{ $notice->title }}</strong><small>{{ $notice->message }}</small></span>
                        </a>
                    @empty
                        <div class="p-3 text-secondary" id="notificationEmpty">No notifications yet.</div>
                    @endforelse
                </div>
            </div>
        </div>
        <a href="{{ route('profile.edit') }}" class="profile-box profile-link" data-tour="profile" data-tour="profile" aria-label="Edit profile">
            @if($avatarUrl)<img src="{{ $avatarUrl }}" alt="{{ $currentUser->name }}" class="avatar avatar-image">
            @else<div class="avatar avatar-fallback">{{ strtoupper(substr($currentUser->name,0,1)) }}</div>@endif
            <div><div class="profile-name">{{ $currentUser->name }}</div><small class="text-primary">{{ $subtitle ?? ucfirst($currentUser->role) }}</small></div>
        </a>
    </div>
    @endauth
</header>
