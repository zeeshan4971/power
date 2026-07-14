@extends('layouts.app', ['hideSidebar' => false])

@section('content')
<main class="main">
    <header class="topbar">
      <h1>Dashboard</h1>

      <div class="profile-box">
        <div class="avatar"></div>
        <div>
          <div class="profile-name">Alex Johnson</div>
          <div class="profile-status">● Doing Well</div>
        </div>
      </div>
    </header>

    <section class="content">

      <div class="card-box status-card mb-4">
        <div>
          <p class="status-label green">Overall Status</p>
          <h2 class="status-title blue">Doing Well</h2>
          <p class="muted-text">Great progress this week!</p>
        </div>

        <div class="progress-ring">
          <div class="ring-inner">
            <div class="ring-score blue">82<span>%</span></div>
            <div class="ring-label">Effort Score</div>
          </div>
        </div>
      </div>

      <div class="row g-4 mb-4">
        <div class="col-md-3 col-sm-6">
          <div class="card-box stat-card">
            <div class="stat-label">Attendance</div>
            <div class="stat-value green">100%</div>
          </div>
        </div>

        <div class="col-md-3 col-sm-6">
          <div class="card-box stat-card">
            <div class="stat-label">Behavior</div>
            <div class="stat-value green">80%</div>
          </div>
        </div>

        <div class="col-md-3 col-sm-6">
          <div class="card-box stat-card">
            <div class="stat-label">Academics</div>
            <div class="stat-value orange">75%</div>
          </div>
        </div>

        <div class="col-md-3 col-sm-6">
          <div class="card-box stat-card">
            <div class="stat-label">Goals Completed</div>
            <div class="stat-value blue">4/5</div>
          </div>
        </div>
      </div>

      <div class="row g-4">
        <div class="col-lg-7">
          <div class="card-box bottom-card">
            <h3 class="bottom-title blue">Recent Activity</h3>

            <div class="activity-main blue">✅ No tardies goal completed</div>
            <div class="activity-sub">Today • Student Check-in</div>

            <div class="activity-main blue">⚠ Effort score slightly dropped</div>
            <div class="activity-sub">2 days ago</div>
          </div>
        </div>

        <div class="col-lg-5">
          <div class="card-box bottom-card reward-card">
            <h3 class="bottom-title blue">Next Reward</h3>
            <div class="activity-main orange">🍕 Dinner out at favorite restaurant</div>

            <div class="reward-ring">85%</div>
          </div>
        </div>
      </div>

    </section>
  </main>
@endsection
