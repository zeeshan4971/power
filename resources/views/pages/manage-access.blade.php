@extends('layouts.app', ['hideSidebar' => false])

@section('content')
<main class="main">

    <header class="topbar">
      <h1>Family &amp; Teachers</h1>
    </header>

    <section class="content">
      <div class="access-card">
        <h2 class="section-title">My Children</h2>

        <div class="child-row">
          <div class="child-info">
            <div class="child-avatar">👱</div>
            <div>
              <div class="child-name">Alex Johnson</div>
              <div class="child-status">Grade 9 • Active</div>
            </div>
          </div>

          <div class="share-icon" data-bs-toggle="modal" data-bs-target="#shareLinkModal">↗</div>
        </div>

        <button class="btn-add" data-bs-toggle="modal" data-bs-target="#createChildModal">+ Add Child</button>
      </div>
    </section>
  </main>
@endsection

@push('modals')
    @include('partials.modals.child-account')
@endpush

@push('modals')
    @include('partials.modals.kids-share')
@endpush
