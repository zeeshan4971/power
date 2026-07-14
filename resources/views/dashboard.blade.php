@extends('layouts.app')

@php
    $activePage = 'home';
@endphp

@section('content')
    <main class="main">

        @include('partials-top', [
            'title' => 'Dashboard',
            'subtitle' => ucfirst(auth()->user()->role),
        ])

        <section class="content">

            @if (empty($student))

                <div class="card-box" data-tour="dashboard-summary">
                    <h3>No student yet</h3>

                    <p>Create a child account from Manage Access.</p>

                    <a class="btn-blue" href="{{ route('manage-access') }}">
                        Manage Access
                    </a>
                </div>

            @else

                @php
                    $effort = (int) ($metrics['effort'] ?? 0);

                    if ($effort >= 80) {
                        $status = 'Doing Well';
                    } elseif ($effort >= 60) {
                        $status = 'Needs Attention';
                    } else {
                        $status = 'At Risk';
                    }

                    $reward = $student->rewards
                        ->sortByDesc('created_at')
                        ->first();

                    $rewardName = optional($reward)->name ?? 'No reward set';
                    $rewardProgress = (int) (optional($reward)->progress ?? 0);

                    $stats = [
                        [
                            'label' => 'Attendance',
                            'value' => (int) ($metrics['attendance'] ?? 0),
                            'class' => 'green',
                        ],
                        [
                            'label' => 'Behavior',
                            'value' => (int) ($metrics['behavior'] ?? 0),
                            'class' => 'green',
                        ],
                        [
                            'label' => 'Academics',
                            'value' => (int) ($metrics['academics'] ?? 0),
                            'class' => 'orange',
                        ],
                    ];

                    $completedGoals = (int) ($metrics['completed'] ?? 0);
                    $totalGoals = (int) ($metrics['total'] ?? 0);
                @endphp

                <div class="card-box dashboard-status" data-tour="dashboard-summary">
                    <div>
                        <h3 class="green fw-bold">Overall Status</h3>

                        <h1 class="fw-bold">
                            {{ $status }}
                        </h1>

                        <p class="muted-text">
                            Calculated from current goal progress.
                        </p>
                    </div>

                    <div
                        class="score-ring"
                        style="--score: {{ $effort }}"
                    >
                        <div>
                            <strong>{{ $effort }}%</strong>
                            <span>Effort Score</span>
                        </div>
                    </div>
                </div>

                <div class="row g-4" data-tour="dashboard-metrics">

                    @foreach ($stats as $stat)
                        <div class="col-md-3">
                            <div class="card-box stat-card">
                                <div>
                                    {{ $stat['label'] }}
                                </div>

                                <div class="stat-value {{ $stat['class'] }}">
                                    {{ $stat['value'] }}%
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="col-md-3">
                        <div class="card-box stat-card">
                            <div>Goals Completed</div>

                            <div class="stat-value">
                                {{ $completedGoals }}/{{ $totalGoals }}
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row g-4 mt-1">

                    <div class="col-md-7">
                        <div class="card-box" data-tour="recent-activity">
                            <h3>Recent Activity</h3>

                            @forelse ($student->goals->sortByDesc('updated_at')->take(4) as $goal)
                                <div class="activity-row">
                                    <span class="activity-icon">
                                        &#10003;
                                    </span>

                                    <div>
                                        {{ $goal->title }}

                                        <small>
                                            {{ (int) ($goal->progress ?? 0) }}% complete
                                        </small>
                                    </div>
                                </div>
                            @empty
                                <p>No activity yet.</p>
                            @endforelse
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="card-box" data-tour="next-reward">
                            <h3>Next Reward</h3>

                            <p class="orange fs-4">
                                {{ $rewardName }}
                            </p>

                            <div class="progress">
                                <div
                                    class="progress-bar bg-warning"
                                    role="progressbar"
                                    style="width: {{ $rewardProgress }}%"
                                    aria-valuenow="{{ $rewardProgress }}"
                                    aria-valuemin="0"
                                    aria-valuemax="100"
                                ></div>
                            </div>

                            <h2 class="orange mt-3">
                                {{ $rewardProgress }}%
                            </h2>
                        </div>
                    </div>

                </div>

            @endif

        </section>
    </main>
@endsection
