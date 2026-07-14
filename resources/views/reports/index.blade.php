@extends('layouts.app')
@php($activePage='reports')
@section('content')
<main class="main">@include('partials-top',['title'=>'Progress Reports','subtitle'=>'Live calculations'])
<section class="content" data-tour="reports-page"><div class="row g-4">
<div class="col-md-8"><div class="card-box"><h2>Effort Score Trend</h2><div class="trend-bars">@foreach($trend as $i=>$value)<div><span style="height:{{ max(8,$value*1.5) }}px"></span><small>Week {{ $i+1 }}<br>{{ $value }}%</small></div>@endforeach</div></div></div>
<div class="col-md-4"><div class="card-box text-center"><h2>Goal Completion</h2><h1 class="green report-number">{{ $metrics['goal_completion'] }}%</h1><p>{{ $metrics['completed'] }} of {{ $metrics['total'] }} complete</p></div></div>
<div class="col-md-8"><div class="card-box"><h2>Category Breakdown</h2><div class="category-bars">@forelse($metrics['categories'] as $name=>$value)<div><span style="height:{{ max(8,$value*1.5) }}px"></span><small>{{ $name }}<br>{{ $value }}%</small></div>@empty<p>No category data.</p>@endforelse</div></div></div>
<div class="col-md-4"><div class="card-box"><h2>Summary</h2><p>Total Goals Set</p><h1>{{ $metrics['total'] }}</h1><p>Rewards Unlocked</p><h1 class="orange">{{ $student?->rewards->where('status','earned')->count() ?? 0 }}</h1></div></div>
</div><button class="btn-black mt-3" onclick="window.print()">Download PDF Report</button></section></main>
@endsection
