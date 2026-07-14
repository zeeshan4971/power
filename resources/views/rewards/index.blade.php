@extends('layouts.app')

@php
    $activePage = 'rewards';
@endphp

@section('content')
    @php
        $reward = null;
        $rewardProgress = 0;
        $rewards = collect();

        if (isset($student) && $student) {
            $rewards = $student->rewards ?? collect();

            $reward = $rewards
                ->sortByDesc('created_at')
                ->first();

            $rewardProgress = (int) (optional($reward)->progress ?? 0);
        }

        $rewardName = optional($reward)->name ?? 'No reward has been set';

        $rewardCondition = optional($reward)->condition
            ?? 'Create a reward condition for this student.';

        $rewardStatus = optional($reward)->status ?? 'pending';
    @endphp

    <main class="main">

        @include('partials-top', [
            'title' => 'Rewards & Motivation',
            'subtitle' => $rewardProgress . '% towards next reward',
        ])

        <section class="content" data-tour="rewards-page">

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="card-box dashboard-status">
                <div>
                    <h2>Current Reward</h2>

                    <h2 class="orange">
                        <span aria-hidden="true">&#127829;</span>
                        {{ $rewardName }}
                    </h2>

                    <p class="muted-text">
                        Condition: {{ $rewardCondition }}
                    </p>
                </div>

                <div
                    class="score-ring reward-score"
                    style="--score: {{ $rewardProgress }}"
                >
                    <div>
                        <strong>{{ $rewardProgress }}%</strong>

                        <span>
                            {{ $rewardStatus === 'earned' ? 'Unlocked' : 'Progress' }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="card-box">
                <h2>Past Rewards</h2>

                <div class="row g-3">
                    @forelse ($rewards->sortByDesc('earned_at') as $item)
                        <div class="col-md-4">
                            <div class="p-4 border rounded bg-light h-100">
                                <strong>
                                    {{ $item->name }}
                                </strong>

                                <br>

                                <small class="{{ $item->status === 'earned' ? 'green' : 'muted-text' }}">
                                    {{ ucfirst($item->status ?? 'pending') }}

                                    @if ($item->earned_at)
                                        &bull; {{ $item->earned_at->format('M j, Y') }}
                                    @endif
                                </small>

                                @if (!empty($item->condition))
                                    <p class="muted-text mt-2 mb-0">
                                        {{ $item->condition }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <p class="mb-0">
                                No rewards yet.
                            </p>
                        </div>
                    @endforelse
                </div>
            </div>

            @if (auth()->check() && auth()->user()->role === 'parent')
                <button
                    type="button"
                    class="btn-black"
                    data-bs-toggle="modal"
                    data-bs-target="#rewardModal"
                >
                    Create New Reward
                </button>

                @include('rewards.modal')
            @endif

        </section>
    </main>
@endsection
