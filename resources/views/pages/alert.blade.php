@extends('layouts.app', ['hideSidebar' => false])

@section('content')
<main class="main">

    <header class="topbar">
      <h1>Early Warning Alerts</h1>

      <div class="profile-box">
        <div class="avatar"></div>
        <div>
          <div class="profile-name">Alex Johnson</div>
          <div class="profile-sub">2 Active Alerts</div>
        </div>
      </div>
    </header>

    <section class="content">

      <div class="tabs-box">
        <div class="tab active">All</div>
        <div class="tab">Active</div>
        <div class="tab">Resolved</div>
      </div>

      <div class="alert-card red-alert">
        <div class="alert-left">
          <div class="alert-icon-box red-box"></div>
          <div>
            <div class="alert-title">🔴 Missing Assignments Increasing</div>
            <div class="alert-desc">3-week trend detected • Academics impacted</div>
          </div>
        </div>

        <div class="alert-action">
          <div>High Priority</div>
          <button class="btn-alert btn-red" data-bs-toggle="modal" data-bs-target="#teacherRequestModal">Take Action</button>
        </div>
      </div>

      <div class="alert-card yellow-alert">
        <div class="alert-left">
          <div class="alert-icon-box yellow-box"></div>
          <div>
            <div class="alert-title">🟡 Effort Score Dropping</div>
            <div class="alert-desc">Dropped for 2 consecutive weeks</div>
          </div>
        </div>

        <div class="alert-action">
          <div>Medium Priority</div>
          <button class="btn-alert btn-yellow">View Details</button>
        </div>
      </div>

      <div class="alert-card green-alert">
        <div class="alert-left">
          <div class="alert-icon-box green-box"></div>
          <div>
            <div class="alert-title" style="font-weight:400;">🟢 Behavior Improved</div>
            <div class="alert-desc">Previous alert resolved • Great improvement!</div>
          </div>
        </div>

        <div class="alert-action">
          Resolved • May 22
        </div>
      </div>

      <div class="recommended">
        <h2>Recommended Actions</h2>
        <ul>
          <li>Schedule a quick check-in with Alex</li>
          <li>Review missing assignments together</li>
          <li>Praise recent behavior improvements</li>
        </ul>
      </div>

    </section>

  </main>
@endsection

@push('modals')
    @include('partials.modals.teacher-check')
@endpush
