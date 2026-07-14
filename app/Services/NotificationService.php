<?php
namespace App\Services;

use App\Models\AppNotification;
use App\Models\Student;
use App\Models\User;

class NotificationService
{
    public function syncFor(User $user): void
    {
        $students = $user->role === 'student'
            ? collect([$user->studentProfile])->filter()
            : $user->children()->with(['goals','feedback','alerts'])->get();

        foreach ($students as $student) {
            $student->loadMissing('goals','feedback','alerts');

            foreach ($student->goals->where('status','active') as $goal) {
                if ($goal->due_date && $goal->due_date->isBetween(today(), today()->addDays(3))) {
                    $this->upsert($user, $student, 'goal_due', 'Goal due soon', $goal->title.' is due '.$goal->due_date->format('M j').'.', route('goals.index'), 'goal-due-'.$user->id.'-'.$goal->id.'-'.$goal->due_date->format('Ymd'));
                }
                if ($goal->progress < 100 && (!$goal->last_progress_at || $goal->last_progress_at->lt(now()->subDays(7)))) {
                    $this->upsert($user, $student, 'progress_stale', 'Progress update needed', $goal->title.' has not been updated recently.', route('goals.index'), 'goal-stale-'.$user->id.'-'.$goal->id.'-'.now()->format('YW'));
                }
            }

            $latestFeedback = $student->feedback->sortByDesc('created_at')->first();
            if (!$latestFeedback || $latestFeedback->created_at->lt(now()->subDays(14))) {
                $this->upsert($user, $student, 'checkin_due', 'Teacher check-in recommended', 'No teacher check-in has been received in the last 14 days.', route('teacher-feedback'), 'checkin-'.$user->id.'-'.$student->id.'-'.now()->format('YW'));
            }

            foreach ($student->alerts->where('status','active') as $alert) {
                $this->upsert($user, $student, 'alert', $alert->title, $alert->description, route('alerts'), 'alert-'.$user->id.'-'.$alert->id);
            }
        }
    }

    private function upsert(User $user, Student $student, string $type, string $title, ?string $message, string $url, string $key): void
    {
        AppNotification::firstOrCreate(['dedupe_key'=>$key], [
            'user_id'=>$user->id,'student_id'=>$student->id,'type'=>$type,'title'=>$title,'message'=>$message,'action_url'=>$url,
        ]);
    }
}
