<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    public function store(Request $request)
    {
        abort_unless(auth()->user()->role === 'parent', 403);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'alpha_dash', 'max:100'],
            'grade' => ['nullable', 'string', 'max:100'],
            'school' => ['nullable', 'string', 'max:255'],
            'password' => ['required', 'min:6'],
        ]);

        $email = strtolower($data['username']) . '@powerguard.local';

        if (User::where('email', $email)->exists()) {
            return back()->withErrors(['username' => 'This username is already in use.'])->withInput();
        }

        $user = User::create([
            'name' => $data['name'],
            'email' => $email,
            'password' => $data['password'],
            'role' => 'student',
            'parent_id' => auth()->id(),
            'grade' => $data['grade'] ?? null,
            'school' => $data['school'] ?? null,
        ]);

        Student::create([
            'user_id' => $user->id,
            'parent_id' => auth()->id(),
            'grade' => $data['grade'] ?? null,
            'school' => $data['school'] ?? null,
        ]);

        return back()->with('success', 'Child account created. Login email: ' . $email);
    }

    public function edit(Student $student)
    {
        $this->authorizeStudentAccess($student);
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $this->authorizeStudentAccess($student);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'age' => ['nullable', 'integer', 'min:1', 'max:120'],
            'grade' => ['nullable', 'string', 'max:100'],
            'school' => ['nullable', 'string', 'max:255'],
            'avatar_url' => ['nullable', 'url', 'max:2048'],
            'strengths' => ['nullable', 'string', 'max:1000'],
            'watch_areas' => ['nullable', 'string', 'max:1000'],
            'parent_notes' => ['nullable', 'string', 'max:3000'],
        ]);

        $student->update(collect($data)->except('name')->toArray());
        $student->user->update([
            'name' => $data['name'],
            'avatar_url' => $data['avatar_url'] ?? null,
            'grade' => $data['grade'] ?? null,
            'school' => $data['school'] ?? null,
        ]);

        return back()->with('success', 'Profile updated.');
    }

    public function destroy(Student $student)
    {
        abort_unless(auth()->user()->role === 'parent' && $student->parent_id === auth()->id(), 403);
        $student->user->delete();
        return back()->with('success', 'Student deleted.');
    }

    private function authorizeStudentAccess(Student $student): void
    {
        $user = auth()->user();
        $allowed = ($user->role === 'parent' && $student->parent_id === $user->id)
            || ($user->role === 'student' && $student->user_id === $user->id);
        abort_unless($allowed, 403);
    }
}
