@extends('layouts.app')

@php
    $activePage = 'teacher-dashboard';
@endphp

@section('content')
<main class="main teacher-role-main">
    @include('partials-top', [
        'title' => 'Teacher Dashboard',
        'subtitle' => $pendingRequests->count() . ' pending check-in' . ($pendingRequests->count() === 1 ? '' : 's'),
    ])

    <section class="content teacher-role-content">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($pendingRequests->isNotEmpty())
            <div class="teacher-alert-banner" id="checkins" data-tour="teacher-checkins">
                <div class="teacher-alert-icon" aria-hidden="true">!</div>
                <div class="flex-grow-1">
                    <strong>{{ $pendingRequests->count() }} parent check-in request{{ $pendingRequests->count() === 1 ? '' : 's' }} need attention</strong>
                    <span>Review the students below and submit a quick progress update.</span>
                </div>
                <a href="#pending-requests" class="btn btn-danger">Review Requests</a>
            </div>
        @endif

        <div class="row g-4 teacher-stat-grid" data-tour="teacher-summary">
            <div class="col-sm-6 col-xl-3">
                <div class="card-box teacher-stat-card">
                    <span class="teacher-stat-label">Pending Check-ins</span>
                    <strong class="teacher-stat-number orange">{{ $pendingRequests->count() }}</strong>
                    <small>Waiting for your response</small>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card-box teacher-stat-card">
                    <span class="teacher-stat-label">Students Assigned</span>
                    <strong class="teacher-stat-number">{{ $students->count() }}</strong>
                    <small>Available through requests</small>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card-box teacher-stat-card">
                    <span class="teacher-stat-label">Goals Updated</span>
                    <strong class="teacher-stat-number green">{{ $updatedThisWeek }}</strong>
                    <small>This week</small>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card-box teacher-stat-card">
                    <span class="teacher-stat-label">Feedback Submitted</span>
                    <strong class="teacher-stat-number">{{ $feedbackCount }}</strong>
                    <small>Total submissions</small>
                </div>
            </div>
        </div>

        <div class="card-box" id="pending-requests" data-tour="teacher-requests">
            <div class="section-heading-row">
                <div>
                    <h2>Pending Parent Requests</h2>
                    <p class="muted-text mb-0">Open a student card to update goals and submit feedback.</p>
                </div>
                <span class="section-count">{{ $pendingRequests->count() }}</span>
            </div>

            @forelse ($pendingRequests as $teacherRequest)
                @php
                    $requestStudent = $teacherRequest->student;
                    $requestUser = $requestStudent?->user;
                    $latestFeedback = $requestStudent?->feedback?->sortByDesc('created_at')->first();
                @endphp

                <div class="teacher-request-card">
                    <div class="teacher-student-summary">
                        <img
                            src="{{ $requestUser?->avatar_url ?: asset('logo.png') }}"
                            alt="{{ $requestUser?->name ?? 'Student' }}"
                            class="teacher-student-avatar"
                        >
                        <div>
                            <h3>{{ $requestUser?->name ?? 'Student' }}</h3>
                            <p>{{ $requestStudent?->grade ?: 'Grade not set' }} • {{ $requestStudent?->school ?: 'School not set' }}</p>
                            <span class="priority-badge {{ $teacherRequest->urgency === 'urgent' ? 'urgent' : 'normal' }}">
                                {{ ucfirst($teacherRequest->urgency) }} priority
                            </span>
                        </div>
                    </div>

                    <div class="teacher-request-message">
                        <small>Parent message</small>
                        <p>{{ $teacherRequest->message ?: 'Please provide a quick update on progress, focus, and participation.' }}</p>
                    </div>

                    <div class="teacher-request-actions">
                        <button
                            type="button"
                            class="btn-black"
                            data-bs-toggle="collapse"
                            data-bs-target="#teacherRequest{{ $teacherRequest->id }}"
                            aria-expanded="false"
                        >
                            Review Student
                        </button>
                    </div>
                </div>

                <div class="collapse teacher-review-panel" id="teacherRequest{{ $teacherRequest->id }}">
                    <div class="row g-4">
                        <div class="col-lg-7" id="goals">
                            <div class="teacher-panel-card">
                                <h3>Current Goals</h3>

                                @forelse ($requestStudent?->goals ?? collect() as $goal)
                                    <form method="POST" action="{{ route('goals.progress', $goal) }}" class="teacher-goal-update-form">
                                        @csrf
                                        <div class="teacher-goal-copy">
                                            <strong>{{ $goal->title }}</strong>
                                            <small>{{ ucfirst($goal->category) }}{{ $goal->due_date ? ' • Due '.$goal->due_date->format('M j') : '' }}</small>
                                        </div>
                                        <div class="teacher-range-wrap">
                                            <input
                                                type="range"
                                                min="0"
                                                max="100"
                                                name="progress"
                                                value="{{ (int) $goal->progress }}"
                                                oninput="this.nextElementSibling.textContent = this.value + '%'"
                                            >
                                            <b>{{ (int) $goal->progress }}%</b>
                                        </div>
                                        <button type="submit" class="btn btn-outline-primary btn-sm">Save</button>
                                    </form>
                                @empty
                                    <p class="muted-text">No active goals are assigned to this student.</p>
                                @endforelse
                            </div>
                        </div>

                        <div class="col-lg-5" id="feedback">
                            <form method="POST" action="{{ route('teacher-feedback.store') }}" class="teacher-panel-card teacher-feedback-form">
                                @csrf
                                <input type="hidden" name="student_id" value="{{ $requestStudent?->id }}">
                                <input type="hidden" name="teacher_request_id" value="{{ $teacherRequest->id }}">
                                <input type="hidden" name="teacher_name" value="{{ auth()->user()->name }}">

                                <h3>Quick Feedback</h3>

                                <label class="form-label">Subject</label>
                                <input class="form-control mb-3" name="subject" value="General Progress">

                                <label class="form-label">Engagement</label>
                                <select class="form-select mb-3" name="engagement" required>
                                    <option>Good</option>
                                    <option>Average</option>
                                    <option>Needs Work</option>
                                    <option>Inconsistent</option>
                                </select>

                                <label class="form-label">Work Completion</label>
                                <select class="form-select mb-3" name="work_completion" required>
                                    <option>Mostly Completed</option>
                                    <option>Partial</option>
                                    <option>Not Completed</option>
                                </select>

                                <label class="form-label">Comment</label>
                                <textarea class="form-control mb-3" name="comment" rows="4" placeholder="Share a concise update for the parent.">{{ old('comment', $latestFeedback?->comment) }}</textarea>

                                <button class="btn-black w-100" type="submit">Submit Feedback</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="teacher-empty-state">
                    <div class="teacher-empty-icon" aria-hidden="true">✓</div>
                    <h3>You are all caught up</h3>
                    <p>No parent check-in requests are waiting for a response.</p>
                </div>
            @endforelse
        </div>

        <div class="card-box" id="students" data-tour="teacher-students">
            <div class="section-heading-row">
                <div>
                    <h2>My Students</h2>
                    <p class="muted-text mb-0">Students connected to your current and previous check-in requests.</p>
                </div>
            </div>

            <div class="row g-3 mt-1">
                @forelse ($students as $teacherStudent)
                    @php
                        $studentUser = $teacherStudent->user;
                        $averageProgress = (int) round($teacherStudent->goals->avg('progress') ?? 0);
                    @endphp
                    <div class="col-md-6 col-xl-4">
                        <div class="teacher-student-card">
                            <img src="{{ $studentUser?->avatar_url ?: asset('logo.png') }}" alt="{{ $studentUser?->name }}">
                            <div class="flex-grow-1">
                                <strong>{{ $studentUser?->name }}</strong>
                                <small>{{ $teacherStudent->grade ?: 'Grade not set' }}</small>
                                <div class="progress mt-2">
                                    <div class="progress-bar" style="width: {{ $averageProgress }}%"></div>
                                </div>
                                <span>{{ $averageProgress }}% average goal progress</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12"><p class="muted-text mb-0">No students are assigned yet.</p></div>
                @endforelse
            </div>
        </div>
    </section>
</main>
@endsection
