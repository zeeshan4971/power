@auth
@php
    $tourUser = auth()->user();
    $tourRole = $tourUser->role;
    $tourShouldStart = is_null($tourUser->onboarding_completed_at);

    $commonEnd = [
        [
            'selector' => '[data-tour="notifications"]',
            'title' => 'Stay informed',
            'text' => 'New goals, check-in requests, progress changes, and feedback appear here. You can also enable Chrome notifications.',
            'url' => route('dashboard'),
        ],
        [
            'selector' => '[data-tour="profile"]',
            'title' => 'Your profile',
            'text' => 'Open your profile to update your name, avatar, school details, or password.',
            'url' => route('dashboard'),
        ],
    ];

    $roleSteps = [
        'parent' => array_merge([
            ['selector' => '[data-tour="page-title"]', 'title' => 'Welcome to PowerGuard', 'text' => 'This guided tour will show you how to support your children, set goals and rewards, and request teacher updates.', 'url' => route('dashboard')],
            ['selector' => '[data-tour="dashboard-summary"]', 'title' => 'Progress at a glance', 'text' => 'The dashboard combines attendance, behavior, academics, goals, and rewards into one clear overview.', 'url' => route('dashboard')],
            ['selector' => '[data-tour="goals-page"]', 'title' => 'Create and follow goals', 'text' => 'Set weekly goals for your child and monitor completion in real time.', 'url' => route('goals.index')],
            ['selector' => '[data-tour="rewards-page"]', 'title' => 'Motivate with rewards', 'text' => 'Create meaningful rewards and connect them to goal completion.', 'url' => route('rewards.index')],
            ['selector' => '[data-tour="teacher-page"]', 'title' => 'Request teacher feedback', 'text' => 'Request a check-in and share a secure temporary dashboard link with the teacher—no teacher login required.', 'url' => route('teacher-feedback')],
            ['selector' => '[data-tour="manage-page"]', 'title' => 'Manage children and access', 'text' => 'Add or remove student accounts, edit child profiles, and create temporary teacher links here.', 'url' => route('manage-access')],
        ], $commonEnd),

        'student' => array_merge([
            ['selector' => '[data-tour="page-title"]', 'title' => 'Welcome to your dashboard', 'text' => 'Track your goals, achievements, behavior, rewards, and progress from one place.', 'url' => route('dashboard')],
            ['selector' => '[data-tour="dashboard-summary"]', 'title' => 'Your progress score', 'text' => 'Your effort score and category results update as you complete goals and receive feedback.', 'url' => route('dashboard')],
            ['selector' => '[data-tour="goals-page"]', 'title' => 'Manage your goals', 'text' => 'Create personal goals and update their progress as you work through them.', 'url' => route('goals.index')],
            ['selector' => '[data-tour="rewards-page"]', 'title' => 'See your rewards', 'text' => 'Watch your reward progress and celebrate rewards you have unlocked.', 'url' => route('rewards.index')],
            ['selector' => '[data-tour="alerts-page"]', 'title' => 'Understand alerts', 'text' => 'Alerts highlight areas that may need attention and improvements you should celebrate.', 'url' => route('alerts')],
        ], $commonEnd),

        'teacher' => array_merge([
            ['selector' => '[data-tour="page-title"]', 'title' => 'Welcome, teacher', 'text' => 'Your teacher dashboard brings check-in requests, assigned students, goals, and feedback into one workspace.', 'url' => route('dashboard')],
            ['selector' => '[data-tour="teacher-summary"]', 'title' => 'Your teaching overview', 'text' => 'See pending check-ins, assigned students, weekly goal updates, and completed feedback at a glance.', 'url' => route('dashboard')],
            ['selector' => '[data-tour="teacher-checkins"]', 'title' => 'Check-in alerts', 'text' => 'Urgent parent requests appear at the top so they are difficult to miss.', 'url' => route('dashboard').'#checkins'],
            ['selector' => '[data-tour="teacher-requests"]', 'title' => 'Review and respond', 'text' => 'Open a student request, update current goal progress, and submit a quick feedback report.', 'url' => route('dashboard').'#pending-requests'],
            ['selector' => '[data-tour="teacher-students"]', 'title' => 'Your students', 'text' => 'Review all students connected to your current and previous check-in requests.', 'url' => route('dashboard').'#students'],
        ], $commonEnd),
    ];

    $tourSteps = $roleSteps[$tourRole] ?? $roleSteps['student'];
@endphp

<script>
window.PowerGuardTour = {
    enabled: @json($tourShouldStart),
    role: @json($tourRole),
    currentStep: {{ (int) $tourUser->onboarding_step }},
    progressUrl: @json(route('onboarding.progress')),
    completeUrl: @json(route('onboarding.complete')),
    dashboardUrl: @json(route('dashboard')),
    csrf: @json(csrf_token()),
    steps: @json($tourSteps),
};
</script>
@endauth
