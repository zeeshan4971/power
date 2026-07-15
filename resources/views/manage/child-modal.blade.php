<div class="modal fade" id="childModal" tabindex="-1" aria-labelledby="childModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered child-modal">
        <form class="modal-content" method="POST" action="{{ route('students.store') }}" novalidate>
            @csrf

            <div class="modal-header bg-primary text-white">
                <h4 class="modal-title" id="childModalLabel">Create Child Account</h4>
                <button class="btn-close btn-close-white" data-bs-dismiss="modal" type="button" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <p class="text-secondary mb-4">The child will sign in with the username and password entered below.</p>

                <div class="mb-3">
                    <label class="form-label" for="child_name">Full Name</label>
                    <input id="child_name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="child_username">Username</label>
                    <input id="child_username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" placeholder="alex.johnson09" autocomplete="off" required>
                    @error('username')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    <small class="text-secondary">Letters, numbers, dots, underscores and dashes only.</small>
                </div>

                <div class="row g-3">
                    <div class="col-md-5">
                        <label class="form-label" for="child_grade">Grade</label>
                        <input id="child_grade" class="form-control @error('grade') is-invalid @enderror" name="grade" value="{{ old('grade') }}" placeholder="9th Grade">
                        @error('grade')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-7">
                        <label class="form-label" for="child_school">School</label>
                        <input id="child_school" class="form-control @error('school') is-invalid @enderror" name="school" value="{{ old('school') }}" placeholder="Lincoln High School">
                        @error('school')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="mt-3">
                    <label class="form-label" for="child_password">Password</label>
                    <input id="child_password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Minimum 6 characters" autocomplete="new-password" required>
                    @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Create Child</button>
            </div>
        </form>
    </div>
</div>

@if ($errors->hasAny(['name', 'username', 'grade', 'school', 'password']))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                bootstrap.Modal.getOrCreateInstance(document.getElementById('childModal')).show();
            });
        </script>
@endif
