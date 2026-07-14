<?php
namespace App\Http\Controllers;

use App\Models\Goal;
use App\Services\ProgressService;
use App\Services\EventNotificationService;
use Illuminate\Http\Request;

class GoalController extends Controller
{
    public function index(){ $student=$this->currentStudent(); return view('goals.index',compact('student')); }

    public function store(Request $request, EventNotificationService $notifications)
    {
        $data=$request->validate([
            'student_id'=>'required|exists:students,id','title'=>'required|max:255','category'=>'required|max:50',
            'target'=>'nullable|max:255','success_criteria'=>'nullable|max:255','due_date'=>'nullable|date'
        ]);
        $student = \App\Models\Student::findOrFail($data['student_id']);
        abort_unless(auth()->user()->role === 'student' ? $student->user_id === auth()->id() : $student->parent_id === auth()->id(), 403);
        $goal = Goal::create($data+['created_by'=>auth()->id(),'last_progress_at'=>now()]);
        $notifications->newGoal($goal, auth()->user());
        return back()->with('success','Goal added');
    }

    public function update(Request $request,Goal $goal, ProgressService $progress)
    {
        $data=$request->validate(['title'=>'required','category'=>'required','target'=>'nullable','success_criteria'=>'nullable','due_date'=>'nullable|date','progress'=>'nullable|integer|min:0|max:100']);
        $value=$data['progress'] ?? null; unset($data['progress']); $goal->update($data);
        if ($value !== null) $progress->updateGoal($goal,(int)$value,auth()->id(),'app');
        return back()->with('success','Goal updated');
    }

    public function destroy(Goal $goal){$goal->delete(); return back()->with('success','Goal deleted');}

    public function progress(Request $request,Goal $goal, ProgressService $progress, EventNotificationService $notifications)
    {
        $data=$request->validate(['progress'=>'required|integer|min:0|max:100']);
        $progress->updateGoal($goal,(int)$data['progress'],auth()->id(),'app');
        $goal->refresh();
        $notifications->progressUpdated($goal, auth()->user());
        return back()->with('success','Progress updated');
    }
}
