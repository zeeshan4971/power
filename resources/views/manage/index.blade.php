@extends('layouts.app')
@php($activePage = 'manage-access')
@section('content')
<main class="main">
@include('partials-top',['title'=>'Family & Teachers','subtitle'=>'Manage access'])
<section class="content" data-tour="manage-page">
@if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
<div class="card-box"><h2 class="mb-4">My Children</h2>
@forelse($children as $child)
<div class="child-access-row">
  <div class="d-flex align-items-center gap-3">
    @if($child->avatar_url ?: $child->user->avatar_url)<img src="{{ $child->avatar_url ?: $child->user->avatar_url }}" class="child-avatar-img" alt="{{ $child->user->name }}">
    @else<div class="child-avatar-fallback">{{ strtoupper(substr($child->user->name,0,1)) }}</div>@endif
    <div><div class="fw-bold fs-5">{{ $child->user->name }}</div><span class="green">{{ $child->grade ?: 'Grade not set' }} • Active</span></div>
  </div>
  <div class="d-flex gap-2 flex-wrap">
    <a href="{{ route('students.edit',$child) }}" class="btn btn-outline-primary">Edit</a>
    @php($existing=$child->teacherLinks->first())
    @if($existing)<button class="btn btn-success" type="button" onclick="openTeacherLink('{{ route('public.feedback',$existing->token) }}','{{ addslashes($child->user->name) }}')">Copy Teacher Link</button>@endif
    <form method="POST" action="{{ route('manage.link',$child) }}">@csrf<button class="btn btn-primary">{{ $existing?'Regenerate Link':'Create Teacher Link' }}</button></form>
    <form method="POST" action="{{ route('students.destroy',$child) }}" onsubmit="return confirm('Delete this student account?')">@csrf @method('DELETE')<button class="btn btn-outline-danger">Delete</button></form>
  </div>
</div>
@empty<div class="alert alert-info">No children have been added yet.</div>@endforelse
<button class="btn-blue mt-3" data-bs-toggle="modal" data-bs-target="#childModal">+ Add Child</button></div>
@include('manage.child-modal')
</section></main>

<div class="modal fade" id="teacherLinkModal" tabindex="-1"><div class="modal-dialog modal-dialog-centered"><div class="modal-content teacher-link-modal"><div class="modal-body">
<h4>Teacher Dashboard Link</h4><p class="text-secondary">Share this secure temporary link with the teacher. No login is required.</p><div class="teacher-link-student" id="teacherLinkStudent"></div><div class="input-group"><input id="teacherLinkValue" class="form-control" readonly><button class="btn btn-success" onclick="copyTeacherLink()">Copy Link</button></div><small class="text-secondary d-block mt-2">The link expires after 14 days.</small>
</div></div></div></div>
@endsection
@section('scripts')
<script>
const linkModal=new bootstrap.Modal(document.getElementById('teacherLinkModal'));
function openTeacherLink(url,name){document.getElementById('teacherLinkValue').value=url;document.getElementById('teacherLinkStudent').textContent=name;linkModal.show();}
function copyTeacherLink(){const input=document.getElementById('teacherLinkValue');navigator.clipboard.writeText(input.value).then(()=>{const b=event.currentTarget;b.textContent='Copied ✓';setTimeout(()=>b.textContent='Copy Link',1800);});}
@if(session('teacher_link'))document.addEventListener('DOMContentLoaded',()=>openTeacherLink(@json(session('teacher_link')),@json(session('teacher_link_student'))));@endif
</script>
@endsection
