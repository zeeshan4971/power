@extends('layouts.app', ['hideSidebar' => false])

@section('content')
<main class="main">

    <header class="topbar">
      <h1>This Week's Goals</h1>

      <div class="profile-box">
        <div class="avatar"></div>
        <div>
          <div class="profile-name">Alex Johnson</div>
          <div class="profile-date">Week of May 25, 2026</div>
        </div>
      </div>
    </header>

    <section class="content-card">
      <h2 class="section-title">This Week's Goals</h2>

      <div class="goal-item">
        <div>
          <div class="goal-title">✅ No tardies this week</div>
          <div class="goal-category green">Attendance Category</div>
        </div>
        <div class="progress-line">
          <div class="progress-fill fill-green w-100-custom"></div>
        </div>
      </div>

      <div class="goal-item">
        <div>
          <div class="goal-title">📚 Complete all homework assignments</div>
          <div class="goal-category orange">Academics Category</div>
        </div>
        <div class="progress-line">
          <div class="progress-fill fill-orange w-65-custom"></div>
        </div>
      </div>

      <div class="goal-item">
        <div>
          <div class="goal-title">🤝 Show respectful behavior in class</div>
          <div class="goal-category green">Behavior Category</div>
        </div>
        <div class="progress-line">
          <div class="progress-fill fill-green w-100-custom"></div>
        </div>
      </div>

      <div class="goal-item">
        <div>
          <div class="goal-title">⏰ Study 30 minutes daily</div>
          <div class="goal-category" style="color:#667895;">Academics Category</div>
        </div>
        <div class="progress-line">
          <div class="progress-fill fill-green w-0-custom"></div>
        </div>
      </div>

      <div class="weekly-progress">
        <div class="weekly-title">Weekly Goal Progress</div>
        <div class="d-flex align-items-end">
          <div class="weekly-percent">75%</div>
          <div class="weekly-text">4 out of 5 goals on track</div>
        </div>
      </div>
    </section>

    <div class="add-btn-wrap">
      <button class="btn-add" data-bs-toggle="modal" data-bs-target="#goalModal">Add New Goal</button>
    </div>

  </main>
@endsection

@push('modals')
    @include('partials.modals.create-goal')
@endpush
