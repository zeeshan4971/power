@extends('layouts.app')
@php($activePage='teacher-feedback')
@section('content')
<main class="main">@include('partials-top',['title'=>'Teacher Pulse Checks','subtitle'=>'Latest feedback'])
<section class="content" data-tour="teacher-page">
@if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
<div class="card-box"><h2>Latest Teacher Feedback</h2>@php($fb=$student?->feedback->sortByDesc('created_at')->first())
<h4>{{ $fb?->teacher_name ?? 'No feedback yet' }}</h4><div class="row"><div class="col"><span class="muted-text">Engagement</span><h3 class="orange">{{ $fb?->engagement ?? '—' }}</h3></div><div class="col"><span class="muted-text">Work Completion</span><h3 class="green">{{ $fb?->work_completion ?? '—' }}</h3></div></div><div class="p-3 border rounded bg-light">{{ $fb?->comment ?? 'Request a teacher check-in to receive an update.' }}</div></div>
<div class="card-box"><h2>Previous Feedback</h2>@forelse($student?->feedback->sortByDesc('created_at')->skip(1) ?? [] as $item)<div class="p-3 border rounded bg-info-subtle mb-3">{{ $item->created_at->format('M d, Y') }} • {{ $item->teacher_name }}<br><small>{{ $item->comment }}</small></div>@empty<p class="muted-text">No previous feedback.</p>@endforelse</div>
<button class="btn-black" data-bs-toggle="modal" data-bs-target="#teacherRequestModal">Request New Check-in</button>@include('teacher.request-modal')
</section></main>

<div class="modal fade" id="requestLinkModal" tabindex="-1"><div class="modal-dialog modal-dialog-centered"><div class="modal-content teacher-link-modal"><div class="modal-body"><h4>Teacher Dashboard Link</h4><p class="text-secondary">The request was recorded. Copy this link and send it to the teacher if email delivery is unavailable.</p><div class="input-group"><input id="requestTeacherLink" class="form-control" readonly value="{{ session('teacher_link') }}"><button type="button" class="btn btn-success" onclick="copyRequestLink(event)">Copy Link</button></div><small class="text-secondary d-block mt-2">No teacher login is required. The link expires after 14 days.</small></div></div></div></div>
@endsection
@section('scripts')
<script>
function copyRequestLink(e){const value=document.getElementById('requestTeacherLink').value;navigator.clipboard.writeText(value).then(()=>{e.currentTarget.textContent='Copied ✓';setTimeout(()=>e.currentTarget.textContent='Copy Link',1800);});}
@if(session('teacher_link'))document.addEventListener('DOMContentLoaded',()=>new bootstrap.Modal(document.getElementById('requestLinkModal')).show());@endif
</script>
@endsection
