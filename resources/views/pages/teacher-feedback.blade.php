@extends('layouts.app', ['hideSidebar' => false])

@section('content')
<main class="main">

    <header class="topbar">
      <h1>Teacher Pulse Checks</h1>

      <div class="profile-box">
        <div class="avatar"></div>
        <div>
          <div class="profile-name">Alex Johnson</div>
          <div class="profile-date">Latest feedback: May 25, 2026</div>
        </div>
      </div>
    </header>

    <section class="content">

      <div class="card-box main-feedback">
        <h2 class="section-title">Latest Teacher Feedback</h2>

        <div class="teacher-row">
          <div class="teacher-avatar">MR</div>
          <div>
            <div class="teacher-name">Ms. Rodriguez</div>
            <div class="teacher-sub">Mathematics Teacher</div>
          </div>
        </div>

        <div class="metrics-row">
          <div>
            <div class="metric-label">Engagement</div>
            <div class="metric-value orange">Inconsistent</div>
          </div>

          <div>
            <div class="metric-label">Work Completion</div>
            <div class="metric-value green">Mostly Completed</div>
          </div>
        </div>

        <div class="quote-box">
          "Alex needs better focus during independent work time.<br>
          He's capable but easily distracted."
        </div>
      </div>

      <div class="card-box previous-card">
        <h2 class="section-title">Previous Feedback</h2>

        <div class="feedback-item">
          <div class="feedback-date">May 18, 2026 • Mr. Thompson (Science)</div>
          <div class="feedback-note">
            Good participation • Needs improvement in homework submission
          </div>
        </div>

        <div class="feedback-item">
          <div class="feedback-date">May 11, 2026 • Ms. Rodriguez (Math)</div>
          <div class="feedback-note">
            Positive attitude • Strong improvement in test scores
          </div>
        </div>
      </div>

      <button class="btn-feedback" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#pulseCheckModal">Give Student Feedback</button>

    </section>
  </main>
@endsection

@push('modals')
    @include('partials.modals.student-pules')
@endpush
