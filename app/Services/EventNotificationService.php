<?php

namespace App\Services;

use App\Models\AppNotification;
use App\Models\Goal;
use App\Models\Student;
use App\Models\TeacherFeedback;
use App\Models\TeacherRequest;
use App\Models\User;

class EventNotificationService
{
    public function newGoal(Goal $goal, User $creator): void
    {
        $goal->loadMissing('student.user');
        $studentUser = $goal->student?->user;

        if ($studentUser && $studentUser->id !== $creator->id) {
            $this->create(
                $studentUser,
                $goal->student,
                'new_goal',
                'New goal assigned',
                $creator->name.' added a new goal: '.$goal->title,
                route('goals.index'),
                'new-goal-'.$goal->id.'-'.$studentUser->id
            );
        }
    }

    public function checkInRequested(TeacherRequest $request): void
    {
        $request->loadMissing('student.user');
        $studentUser = $request->student?->user;

        if ($studentUser) {
            $this->create(
                $studentUser,
                $request->student,
                'checkin_requested',
                'Teacher check-in requested',
                'A teacher progress check-in was requested for you.',
                route('teacher-feedback'),
                'checkin-request-student-'.$request->id
            );
        }

        $teacher = User::query()
            ->where('role', 'teacher')
            ->where(function ($query) use ($request) {
                if ($request->teacher_email) {
                    $query->where('email', $request->teacher_email);
                } else {
                    $query->where('name', $request->teacher_name);
                }
            })
            ->first();

        if ($teacher) {
            $this->create(
                $teacher,
                $request->student,
                'teacher_checkin_request',
                'Student check-in requested',
                'A parent requested a progress check-in for '.$request->student->user->name.'.',
                route('dashboard').'#checkins',
                'checkin-request-teacher-'.$request->id.'-'.$teacher->id
            );
        }
    }

    public function feedbackSubmitted(TeacherFeedback $feedback): void
    {
        $feedback->loadMissing('student.user', 'student.parent');
        $student = $feedback->student;

        foreach (collect([$student?->parent, $student?->user])->filter()->unique('id') as $user) {
            $this->create(
                $user,
                $student,
                'teacher_feedback',
                'New teacher feedback',
                $feedback->teacher_name.' submitted a progress update for '.$student->user->name.'.',
                route('teacher-feedback'),
                'feedback-'.$feedback->id.'-'.$user->id
            );
        }
    }

    public function progressUpdated(Goal $goal, ?User $updatedBy): void
    {
        $goal->loadMissing('student.user', 'student.parent');
        $student = $goal->student;
        $recipients = collect([$student?->parent, $student?->user])->filter()->unique('id');

        foreach ($recipients as $user) {
            if ($updatedBy && $user->id === $updatedBy->id) {
                continue;
            }

            $this->create(
                $user,
                $student,
                'goal_progress',
                'Goal progress updated',
                $goal->title.' is now '.$goal->progress.'% complete.',
                route('goals.index'),
                'goal-progress-'.$goal->id.'-'.$goal->updated_at?->timestamp.'-'.$user->id
            );
        }
    }

    private function create(User $user, ?Student $student, string $type, string $title, string $message, string $url, string $key): void
    {
        AppNotification::firstOrCreate(
            ['dedupe_key' => $key],
            [
                'user_id' => $user->id,
                'student_id' => $student?->id,
                'type' => $type,
                'title' => $title,
                'message' => $message,
                'action_url' => $url,
            ]
        );
    }
}
