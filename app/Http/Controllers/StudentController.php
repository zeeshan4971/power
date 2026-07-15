<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Throwable;

class StudentController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        abort_unless(auth()->check() && auth()->user()->role === 'parent', 403);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'min:3', 'max:100', 'regex:/^[A-Za-z0-9._-]+$/', 'unique:users,username'],
            'grade' => ['nullable', 'string', 'max:100'],
            'school' => ['nullable', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:6', 'max:255'],
        ], [
            'username.regex' => 'Username may only contain letters, numbers, dots, underscores and dashes.',
            'username.unique' => 'This student username is already being used.',
        ]);

        $username = strtolower(trim($data['username']));
        $internalEmail = $username.'@powerguard.local';

        try {
            $student = DB::transaction(function () use ($data, $username, $internalEmail) {
                $user = User::create([
                    'name' => trim($data['name']),
                    'email' => $internalEmail,
                    'username' => $username,
                    'password' => $data['password'],
                    'role' => 'student',
                    'parent_id' => auth()->id(),
                    'grade' => $data['grade'] ?? null,
                    'school' => $data['school'] ?? null,
                ]);

                return Student::create([
                    'user_id' => $user->id,
                    'parent_id' => auth()->id(),
                    'grade' => $data['grade'] ?? null,
                    'school' => $data['school'] ?? null,
                ]);
            });

            return redirect()
                ->route('manage-access')
                ->with('success', 'Child account created successfully. Username: '.$username)
                ->with('child_credentials', [
                    'name' => $student->user->name,
                    'username' => $username,
                ]);
        } catch (Throwable $exception) {
            Log::error('Child account creation failed', [
                'parent_id' => auth()->id(),
                'username' => $username,
                'message' => $exception->getMessage(),
            ]);

            return back()
                ->withInput($request->except('password'))
                ->with('error', 'The child account could not be created. Please try again. Technical details were saved to the Laravel log.');
        }
    }

    public function edit(Student $student): View
    {
        $this->authorizeStudentAccess($student);

        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student): RedirectResponse
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

        DB::transaction(function () use ($student, $data) {
            $student->update(collect($data)->except('name')->toArray());
            $student->user->update([
                'name' => $data['name'],
                'avatar_url' => $data['avatar_url'] ?? null,
                'grade' => $data['grade'] ?? null,
                'school' => $data['school'] ?? null,
            ]);
        });

        return back()->with('success', 'Profile updated.');
    }

    public function destroy(Student $student): RedirectResponse
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
