<?php
namespace App\Http\Controllers;

use App\Models\GoalProgressLog;
use App\Services\ProgressService;

class ReportController extends Controller
{
    public function index(ProgressService $progress)
    {
        $student=$this->currentStudent();
        $metrics=$progress->metrics($student);
        $trend=collect(range(3,0))->map(function($weeksAgo) use($student){
            if(!$student) return 0;
            $start=now()->subWeeks($weeksAgo)->startOfWeek();
            $end=(clone $start)->endOfWeek();
            $avg=GoalProgressLog::where('student_id',$student->id)->whereBetween('created_at',[$start,$end])->avg('progress');
            return (int) round($avg ?? ($student->goals->avg('progress') ?? 0));
        });
        return view('reports.index',compact('student','metrics','trend'));
    }
}
