<?php

namespace App\Http\Controllers;

use App\Models\TeacherFeedback;
use App\Models\TeacherRequest;
use App\Services\NotificationService;
use App\Services\ProgressService;

class DashboardController extends Controller
{
    public function index(ProgressService $progress, NotificationService $notifications)
    {
        $user = auth()->user();
        $notifications->syncFor($user);
        $appNotifications = $user->appNotifications()->latest()->take(8)->get();

        if ($user->role === 'teacher') {
            $requests = TeacherRequest::query()
                ->with(['student.user', 'student.goals', 'student.rewards', 'student.feedback'])
                ->where(function ($query) use ($user) {
                    $query->where('teacher_email', $user->email)
                        ->orWhere(function ($nameQuery) use ($user) {
                            $nameQuery->whereNull('teacher_email')
                                ->where('teacher_name', $user->name);
                        });
                })
                ->latest()
                ->get();

            $pendingRequests = $requests->whereIn('status', ['sent', 'viewed']);
            $students = $requests->pluck('student')->filter()->unique('id')->values();
            $goalCount = $students->sum(fn ($student) => $student->goals->count());
            $updatedThisWeek = $students->sum(fn ($student) => $student->goals
                ->where('updated_at', '>=', now()->startOfWeek())->count());
            $feedbackCount = TeacherFeedback::query()
                ->where(function ($query) use ($user) {
                    $query->where('teacher_email', $user->email)
                        ->orWhere(function ($nameQuery) use ($user) {
                            $nameQuery->whereNull('teacher_email')
                                ->where('teacher_name', $user->name);
                        });
                })
                ->count();

            return view('teacher.dashboard', compact(
                'requests',
                'pendingRequests',
                'students',
                'goalCount',
                'updatedThisWeek',
                'feedbackCount',
                'appNotifications'
            ));
        }

        $student = $this->currentStudent();
        $metrics = $progress->metrics($student);

        return view('dashboard', compact('student', 'metrics', 'appNotifications'));
    }
}
