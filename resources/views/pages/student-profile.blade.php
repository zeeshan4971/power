@extends('layouts.app', ['hideSidebar' => false])

@section('content')
<main class="main">
    <header class="topbar">
      <h1>Edit Student Profile</h1>
    </header>

    <section class="profile-card">
      <div class="row">

        <div class="col-lg-3 photo-box">
          <h3 class="profile-title">Profile Picture</h3>

          <div class="avatar-large">👱</div>

          <button class="btn-black">Change Photo</button>
        </div>

        <div class="col-lg-8 offset-lg-1">
          <h3 class="profile-title mt-2">Basic Information</h3>

          <div class="mb-3">
            <label>Full Name</label>
            <input type="text" class="form-control" value="Alex Johnson">
          </div>

          <div class="row mb-3">
            <div class="col-md-5">
              <label>Age</label>
              <input type="text" class="form-control" value="14">
            </div>

            <div class="col-md-5">
              <label>Grade</label>
              <input type="text" class="form-control" value="9th Grade">
            </div>
          </div>

          <div class="mb-3">
            <label>Strengths</label>
            <input type="text" class="form-control" value="Mathematics, Science, Basketball">
          </div>

          <div class="mb-3">
            <label>Areas to Watch / Improve</label>
            <input type="text" class="form-control" value="Focus during independent work">
          </div>

          <div>
            <label>Parent Notes</label>
            <textarea class="form-control">Alex responds well to positive reinforcement and gaming rewards.</textarea>
          </div>
        </div>

      </div>

      <div class="row action-row">
        <div class="col-lg-3">
          <button class="btn-cancel">Cancel</button>
        </div>

        <div class="col-lg-4 offset-lg-1">
          <button class="btn-save">Save Changes</button>
        </div>
      </div>
    </section>
  </main>
@endsection
