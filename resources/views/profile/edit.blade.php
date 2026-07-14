@extends('layouts.app')

@section('content')
<main class="main">
    <header class="topbar">
        <h1>Edit {{ ucfirst($user->role) }} Profile</h1>
    </header>

    <section class="content">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form class="card-box" method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PUT')

            <div class="row g-4">
                <div class="col-lg-3 text-center">
                    <h4 class="mb-3">Profile Picture</h4>

                    @if($user->avatar_url)
                        <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}" class="profile-avatar-large mb-3">
                    @else
                        <div class="profile-avatar-large profile-avatar-placeholder mb-3">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                    @endif

                    <label class="form-label text-start d-block">Avatar URL</label>
                    <input type="url" name="avatar_url" class="form-control" value="{{ old('avatar_url', $user->avatar_url) }}" placeholder="https://example.com/avatar.jpg">
                </div>

                <div class="col-lg-8 offset-lg-1">
                    <h4 class="mb-3">Basic Information</h4>

                    <label class="form-label">Full Name</label>
                    <input class="form-control mb-3" name="name" value="{{ old('name', $user->name) }}" required>

                    <label class="form-label">Email</label>
                    <input type="email" class="form-control mb-3" name="email" value="{{ old('email', $user->email) }}" required>

                    @if($user->role === 'student' && $student)
                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label">Age</label>
                                <input type="number" class="form-control mb-3" name="age" value="{{ old('age', $student->age) }}">
                            </div>
                            <div class="col-md-8">
                                <label class="form-label">Grade</label>
                                <input class="form-control mb-3" name="grade" value="{{ old('grade', $student->grade) }}">
                            </div>
                        </div>

                        <label class="form-label">School</label>
                        <input class="form-control mb-3" name="school" value="{{ old('school', $student->school) }}">

                        <label class="form-label">Strengths</label>
                        <input class="form-control mb-3" name="strengths" value="{{ old('strengths', $student->strengths) }}">

                        <label class="form-label">Areas to Watch / Improve</label>
                        <input class="form-control mb-3" name="watch_areas" value="{{ old('watch_areas', $student->watch_areas) }}">

                        <label class="form-label">Notes</label>
                        <textarea class="form-control mb-3" name="parent_notes" rows="4">{{ old('parent_notes', $student->parent_notes) }}</textarea>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="d-flex gap-3 mt-4">
                        <a href="{{ route('dashboard') }}" class="btn btn-light px-5">Cancel</a>
                        <button type="submit" class="btn-black">Save Changes</button>
                    </div>
                </div>
            </div>
        </form>
    </section>
</main>
@endsection
