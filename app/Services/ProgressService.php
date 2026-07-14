<?php
namespace App\Services;

use App\Models\Goal;
use App\Models\GoalProgressLog;
use App\Models\Student;

class ProgressService
{
    public function updateGoal(Goal $goal, int $progress, ?int $updatedBy = null, string $source = 'app'): void
    {
        $progress = max(0, min(100, $progress));
        $goal->update([
            'progress' => $progress,
            'status' => $progress >= 100 ? 'completed' : 'active',
            'last_progress_at' => now(),
        ]);

        GoalProgressLog::create([
            'goal_id' => $goal->id,
            'student_id' => $goal->student_id,
            'updated_by' => $updatedBy,
            'progress' => $progress,
            'source' => $source,
        ]);

        $this->recalculateRewards($goal->student);
    }

    public function recalculateRewards(Student $student): void
    {
        $student->loadMissing('goals', 'rewards');
        $average = (int) round($student->goals->avg('progress') ?? 0);

        foreach ($student->rewards as $reward) {
            $earned = $average >= 100;
            $reward->update([
                'progress' => $average,
                'status' => $earned ? 'earned' : 'locked',
                'earned_at' => $earned ? ($reward->earned_at ?? now()) : null,
            ]);
        }
    }

    public function metrics(?Student $student): array
    {
        if (!$student) {
            return ['effort'=>0,'goal_completion'=>0,'completed'=>0,'total'=>0,'categories'=>[],'behavior'=>0,'attendance'=>0,'academics'=>0];
        }

        $student->loadMissing('goals');
        $goals = $student->goals;
        $category = fn(string $name) => (int) round($goals->where('category', $name)->avg('progress') ?? 0);
        $total = $goals->count();
        $completed = $goals->where('status', 'completed')->count();

        return [
            'effort' => (int) round($goals->avg('progress') ?? 0),
            'goal_completion' => $total ? (int) round(($completed / $total) * 100) : 0,
            'completed' => $completed,
            'total' => $total,
            'categories' => $goals->groupBy('category')->map(fn($items)=>(int) round($items->avg('progress')))->all(),
            'attendance' => $category('Attendance'),
            'behavior' => $category('Behavior'),
            'academics' => $category('Academics'),
        ];
    }
}
