<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\TeacherRequest;

abstract class Controller
{
    protected function currentStudent(): ?Student
    {
        $user = auth()->user();

        if (!$user) {
            return null;
        }

        $relations = ['user', 'parent', 'goals.logs', 'rewards', 'feedback', 'alerts', 'teacherRequests'];

        if ($user->role === 'student') {
            return Student::with($relations)->where('user_id', $user->id)->first();
        }

        if ($user->role === 'teacher') {
            $request = TeacherRequest::query()
                ->where(function ($query) use ($user) {
                    $query->where('teacher_email', $user->email)
                        ->orWhere(function ($nameQuery) use ($user) {
                            $nameQuery->whereNull('teacher_email')
                                ->where('teacher_name', $user->name);
                        });
                })
                ->latest()
                ->first();

            return $request?->student()->with($relations)->first();
        }

        return $user->children()->with($relations)->first();
    }
}
