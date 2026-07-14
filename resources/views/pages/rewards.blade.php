@extends('layouts.app', ['hideSidebar' => false])

@section('content')
<style>
  .modal-backdrop.show {
    opacity: 0.7;
  }

  .reward-modal {
    max-width: 720px;
  }

  .reward-modal .modal-content {
    border: none;
    border-radius: 0 0 28px 28px;
    overflow: hidden;
  }

  .reward-modal .modal-header {
    background: #000;
    color: #fff;
    height: 80px;
    border: none;
    border-radius: 28px;
    justify-content: center;
    position: relative;
  }

  .reward-modal .modal-title {
    font-size: 26px;
    font-weight: 800;
  }

  .btn-close-custom {
    position: absolute;
    right: 22px;
    top: 22px;
    width: 38px;
    height: 38px;
    border-radius: 50%;
    border: none;
    background: #444;
    color: #fff;
    font-size: 34px;
    line-height: 30px;
  }

  .reward-modal .modal-body {
    padding: 20px 50px 22px;
  }

  .section-title {
    color: #1f3f93;
    font-size: 19px;
    font-weight: 800;
    margin-bottom: 22px;
  }

  .reward-modal .form-label {
    color: #667895;
    font-size: 15px;
    margin-bottom: 8px;
  }

  .reward-modal .form-control {
    height: 60px;
    border-radius: 13px;
    border: 2px solid #e0e7ef;
    background: #f8fbff;
    color: #1f3f93;
    font-size: 17px;
    padding: 0 20px;
  }

  .category-btn {
    width: 100%;
    height: 54px;
    border-radius: 12px;
    border: 2px solid #e0e7ef;
    background: #f8fbff;
    color: #667895;
    font-size: 16px;
  }

  .category-btn.active {
    border-color: #1688ff;
    color: #1688ff;
    background: #eef6ff;
  }

  .preview-box {
    min-height: 110px;
    border: 2px solid #ffc400;
    background: #fffbe8;
    border-radius: 20px;
    padding: 22px 50px;
  }

  .preview-title {
    color: #d88400;
    font-size: 22px;
    margin-bottom: 4px;
  }

  .preview-text {
    color: #9b5d00;
    font-size: 15px;
  }

  .btn-cancel,
  .btn-create {
    width: 100%;
    height: 60px;
    border-radius: 13px;
    font-size: 16px;
    font-weight: 800;
  }

  .btn-cancel {
    background: #fff;
    border: 2px solid #e0e7ef;
    color: #667895;
  }

  .btn-create {
    background: #000;
    border: none;
    color: #fff;
  }
</style>

<main class="main">

    <header class="topbar">
      <h1>Rewards & Motivation</h1>

      <div class="profile-box">
        <div class="avatar"></div>
        <div>
          <div class="profile-name">Alex Johnson</div>
          <div class="profile-sub">85% towards next reward</div>
        </div>
      </div>
    </header>

    <section class="content">

      <div class="card-box current-card">
        <div>
          <h2 class="section-title">Current Reward</h2>
          <div class="reward-title">🍕 Dinner out at favorite restaurant</div>
          <div class="muted-text">Condition: Complete 100% of goals this month</div>
        </div>

        <div class="reward-ring">
          <div class="ring-inner">
            <div class="ring-percent">85<span>%</span></div>
            <div class="ring-text">Almost Unlocked!</div>
          </div>
        </div>
      </div>

      <div class="card-box past-card">
        <h2 class="section-title">Past Rewards</h2>

        <div class="past-grid">
          <div class="past-item">
            🎮 Extra Gaming Time
            <div class="past-status green">Earned on May 18</div>
          </div>

          <div class="past-item">
            🏀 Basketball Game
            <div class="past-status green">Earned on May 4</div>
          </div>

          <div class="past-item">
            🍦 Ice Cream Night
            <div class="past-status gray">Not Earned</div>
          </div>
        </div>
      </div>

      <button class="btn-create" data-bs-toggle="modal" data-bs-target="#rewardModal">Create New Reward</button>

    </section>

  </main>
@endsection

@push('modals')
    @include('partials.modals.create-reward')
@endpush
