@extends('layouts.app', ['hideSidebar' => false])

@section('content')
<main class="main">

    <header class="topbar">
      <h1>Progress Reports</h1>

      <div class="profile-box">
        <div class="avatar"></div>
        <div>
          <div class="profile-name">Alex Johnson</div>
          <div class="profile-sub">Last 30 days • May 2026</div>
        </div>
      </div>
    </header>

    <section class="content">

      <div class="filter-box">
        <div class="filter-btn active">This Month</div>
        <div class="filter-btn">Last 3 Months</div>
        <div class="filter-btn">All Time</div>
      </div>

      <div class="row g-4">
        <div class="col-lg-8">
          <div class="report-card">
            <h2 class="card-title">Effort Score Trend</h2>

            <div class="trend-chart">
              <svg class="trend-svg" viewBox="0 0 520 160">
                <polyline
                  points="0,130 70,90 135,100 205,45 270,70 350,15 395,25"
                  fill="none"
                  stroke="#000"
                  stroke-width="7"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                />
                <circle cx="0" cy="130" r="7" fill="#1e88e5"/>
                <circle cx="135" cy="100" r="7" fill="#1e88e5"/>
                <circle cx="270" cy="70" r="7" fill="#1e88e5"/>
                <circle cx="395" cy="25" r="7" fill="#1e88e5"/>
              </svg>

              <div class="week-labels">
                <span>Week 1</span>
                <span>Week 2</span>
                <span>Week 3</span>
                <span>Week 4</span>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="report-card">
            <h2 class="card-title">Goal Completion</h2>
            <div class="big-percent">78%</div>
            <div class="sub-text">Average this month</div>
          </div>
        </div>

        <div class="col-lg-8">
          <div class="report-card">
            <h2 class="card-title">Category Breakdown</h2>

            <div class="bars">
              <div class="bar-wrap">
                <div class="bar green" style="height:150px;"></div>
                Attendance
              </div>

              <div class="bar-wrap">
                <div class="bar green" style="height:128px;"></div>
                Behavior
              </div>

              <div class="bar-wrap">
                <div class="bar orange" style="height:95px;"></div>
                Academics
              </div>

              <div class="bar-wrap">
                <div class="bar green" style="height:140px;"></div>
                Focus
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="report-card summary-box">
            <h2 class="card-title">Summary</h2>

            <div class="summary-label">Total Goals Set</div>
            <div class="summary-value">28</div>

            <div class="summary-label">Rewards Unlocked</div>
            <div class="summary-value orange-text">6</div>
          </div>
        </div>
      </div>

      <button class="btn-download">Download PDF Report</button>

    </section>

  </main>
@endsection
