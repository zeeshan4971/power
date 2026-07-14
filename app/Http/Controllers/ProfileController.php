<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        $student = $user->role === 'student'
            ? $user->studentProfile
            : null;

        return view('profile.edit', compact('user', 'student'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'avatar_url' => ['nullable', 'url', 'max:2048'],
            'age' => ['nullable', 'integer', 'min:1', 'max:120'],
            'grade' => ['nullable', 'string', 'max:100'],
            'school' => ['nullable', 'string', 'max:255'],
            'strengths' => ['nullable', 'string', 'max:1000'],
            'watch_areas' => ['nullable', 'string', 'max:1000'],
            'parent_notes' => ['nullable', 'string', 'max:3000'],
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'avatar_url' => $validated['avatar_url'] ?? null,
            'grade' => $validated['grade'] ?? $user->grade,
            'school' => $validated['school'] ?? $user->school,
        ]);

        if ($user->role === 'student' && $user->studentProfile) {
            $user->studentProfile->update([
                'age' => $validated['age'] ?? null,
                'grade' => $validated['grade'] ?? null,
                'school' => $validated['school'] ?? null,
                'avatar_url' => $validated['avatar_url'] ?? null,
                'strengths' => $validated['strengths'] ?? null,
                'watch_areas' => $validated['watch_areas'] ?? null,
                'parent_notes' => $validated['parent_notes'] ?? null,
            ]);
        }

        return back()->with('success', 'Profile updated successfully.');
    }
}
