@extends('layouts.app')
@php($activePage='goals')
@section('content')
<main class="main">@include('partials-top',['title'=>"This Week's Goals",'subtitle'=>now()->format('M Y')])
<section class="content" data-tour="goals-page"><div class="card-box"><h2>This Week's Goals</h2>
@php($overall=(int)round($student?->goals->avg('progress')??0))
@forelse($student?->goals ?? [] as $goal)
<div class="goal-row"><div><h5>{{ $goal->title }}</h5><small class="{{ $goal->category==='Academics'?'orange':'green' }}">{{ $goal->category }} Category @if($goal->due_date) • Due {{ $goal->due_date->format('M j') }} @endif</small></div>
<form method="POST" action="{{ route('goals.progress',$goal) }}" class="goal-progress-form">@csrf<input type="range" name="progress" min="0" max="100" value="{{ $goal->progress }}" oninput="this.nextElementSibling.textContent=this.value+'%'" onchange="this.form.submit()"><b>{{ $goal->progress }}%</b></form></div>
@empty<p>No goals yet.</p>@endforelse
<div class="weekly-box"><h4>Weekly Goal Progress</h4><h1>{{ $overall }}%</h1><p>{{ $student?->goals->where('status','completed')->count() ?? 0 }} out of {{ $student?->goals->count() ?? 0 }} goals completed</p></div></div>
<button class="btn-black" data-bs-toggle="modal" data-bs-target="#goalModal">Add New Goal</button>@include('goals.modal')</section></main>
@endsection
