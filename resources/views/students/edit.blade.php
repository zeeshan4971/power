@extends('layouts.app')

@section('content')
<main class="main">
    <header class="topbar"><h1>Edit Student Profile</h1></header>

    <section class="content">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form class="card-box" method="POST" action="{{ route('students.update', $student) }}">
            @csrf
            @method('PUT')

            <div class="row g-4">
                <div class="col-lg-3 text-center">
                    <h4>Profile Picture</h4>
                    @if($student->avatar_url ?: $student->user->avatar_url)
                        <img src="{{ $student->avatar_url ?: $student->user->avatar_url }}" alt="{{ $student->user->name }}" class="profile-avatar-large mb-3">
                    @else
                        <div class="profile-avatar-large profile-avatar-placeholder mb-3">{{ strtoupper(substr($student->user->name, 0, 1)) }}</div>
                    @endif
                    <label class="form-label text-start d-block">Avatar URL</label>
                    <input type="url" name="avatar_url" class="form-control" value="{{ old('avatar_url', $student->avatar_url ?: $student->user->avatar_url) }}">
                </div>

                <div class="col-lg-8 offset-lg-1">
                    <h4>Basic Information</h4>
                    <label>Full Name</label>
                    <input class="form-control mb-3" name="name" value="{{ old('name', $student->user->name) }}">

                    <div class="row">
                        <div class="col-md-4">
                            <label>Age</label>
                            <input class="form-control mb-3" name="age" value="{{ old('age', $student->age) }}">
                        </div>
                        <div class="col-md-8">
                            <label>Grade</label>
                            <input class="form-control mb-3" name="grade" value="{{ old('grade', $student->grade) }}">
                        </div>
                    </div>

                    <label>School</label>
                    <input class="form-control mb-3" name="school" value="{{ old('school', $student->school) }}">
                    <label>Strengths</label>
                    <input class="form-control mb-3" name="strengths" value="{{ old('strengths', $student->strengths) }}">
                    <label>Areas to Watch / Improve</label>
                    <input class="form-control mb-3" name="watch_areas" value="{{ old('watch_areas', $student->watch_areas) }}">
                    <label>Parent Notes</label>
                    <textarea class="form-control mb-3" name="parent_notes">{{ old('parent_notes', $student->parent_notes) }}</textarea>
                </div>
            </div>

            <a href="{{ route('manage-access') }}" class="btn btn-light px-5">Cancel</a>
            <button class="btn-black ms-3">Save Changes</button>
        </form>
    </section>
</main>
@endsection
