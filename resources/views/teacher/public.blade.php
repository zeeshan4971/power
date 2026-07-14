@extends('layouts.app',['hideSidebar'=>true])
@section('content')
<div class="teacher-dashboard-shell">
  <aside class="teacher-sidebar">
    <img src="{{ asset('logo.png') }}" class="teacher-logo" alt="PowerGuard">
    <a href="#overview" class="active">Overview</a>
    <a href="#goals">Goals</a>
    <a href="#feedback">Feedback</a>
  </aside>
  <main class="teacher-main">
    <header class="teacher-topbar">
      <div>
        <h1>{{ $student->user->name }} Dashboard</h1>
        <p>{{ $student->grade }} • {{ $student->school }}</p>
      </div>
      <div class="d-flex gap-2 align-items-center"><button type="button" class="btn btn-outline-primary btn-sm" id="teacherBrowserNotify">Enable Chrome Notifications</button><div class="teacher-profile">Teacher Access</div></div>
    </header>

    <section class="teacher-content">
      @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
      @if($requests->count())
      <div class="teacher-request-banner">
        <div>
          <strong>{{ $requests->count() }} check-in request{{ $requests->count()>1?'s':'' }}</strong>
          <span>{{ $requests->first()->message ?: 'A parent requested a progress update.' }}</span>
        </div>
        <a href="#feedback" class="btn btn-danger">Respond Now</a>
      </div>
      @endif

      <div id="overview" class="row g-4 mb-4">
        <div class="col-md-8"><div class="card-box dashboard-status"><div><h3>Current Progress</h3><h1>{{ $metrics['effort'] }}%</h1><p>Average across all goals</p></div><div class="score-ring" style="--score:{{ $metrics['effort'] }}"><div><strong>{{ $metrics['effort'] }}%</strong><span>Effort</span></div></div></div></div>
        <div class="col-md-4"><div class="card-box"><h3>Open Requests</h3><div class="report-number orange">{{ $requests->count() }}</div><p>Waiting for teacher response</p></div></div>
      </div>

      <form method="POST" action="{{ route('public.feedback',$link->token) }}" id="feedback">
        @csrf
        <div id="goals" class="card-box">
          <h2>Update Current Goals</h2>
          @forelse($student->goals as $goal)
          <div class="teacher-goal-row">
            <div><strong>{{ $goal->title }}</strong><small>{{ $goal->category }} @if($goal->due_date) • Due {{ $goal->due_date->format('M j') }} @endif</small></div>
            <div class="goal-progress-form"><input type="range" min="0" max="100" name="goal_progress[{{ $goal->id }}]" value="{{ $goal->progress }}" oninput="this.nextElementSibling.textContent=this.value+'%'"><b>{{ $goal->progress }}%</b></div>
          </div>
          @empty<p>No goals are currently assigned.</p>@endforelse
        </div>

        <div class="card-box">
          <h2>Quick Student Pulse Check</h2>
          <div class="row g-3">
            <div class="col-md-6"><label>Teacher Name</label><input class="form-control" name="teacher_name" required value="{{ old('teacher_name',$requests->first()?->teacher_name) }}"></div>
            <div class="col-md-6"><label>Email</label><input type="email" class="form-control" name="teacher_email" value="{{ old('teacher_email',$requests->first()?->teacher_email) }}"></div>
            <div class="col-md-6"><label>Subject</label><input class="form-control" name="subject" value="{{ old('subject','General Progress') }}"></div>
            <div class="col-md-3"><label>Engagement</label><select name="engagement" class="form-select" required><option>Good</option><option>Average</option><option>Needs Work</option><option>Inconsistent</option></select></div>
            <div class="col-md-3"><label>Work Completion</label><select name="work_completion" class="form-select" required><option>Mostly Completed</option><option>Partial</option><option>Not Completed</option></select></div>
            <div class="col-12"><label>Feedback</label><textarea class="form-control" name="comment" rows="4" placeholder="Share a concise update for the parent.">{{ old('comment') }}</textarea></div>
          </div>
          <button class="btn-black w-100 mt-4">Submit Feedback & Progress</button>
        </div>
      </form>
    </section>
  </main>
</div>
@endsection
@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', async () => {
    const button = document.getElementById('teacherBrowserNotify');
    if (!button || !('Notification' in window) || !('serviceWorker' in navigator)) return;
    const registration = await navigator.serviceWorker.register('/service-worker.js');
    const update = () => {
        if (Notification.permission === 'granted') button.textContent = 'Chrome Notifications Enabled';
        if (Notification.permission === 'denied') { button.textContent = 'Notifications Blocked'; button.disabled = true; }
    };
    button.addEventListener('click', async () => {
        await Notification.requestPermission();
        update();
        @if($requests->count())
        if (Notification.permission === 'granted') {
            registration.showNotification('Student check-in requested', {
                body: @json(($requests->first()->message ?: 'A parent requested a progress update for '.$student->user->name.'.')),
                icon: '/logo.png',
                badge: '/logo.png',
                tag: 'teacher-checkin-{{ $student->id }}',
                data: { url: window.location.href }
            });
        }
        @endif
    });
    update();
});
</script>
@endsection
