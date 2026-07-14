<?php
namespace App\Http\Controllers;

use App\Models\TeacherFeedback;
use App\Models\TeacherLink;
use App\Services\ProgressService;
use App\Services\EventNotificationService;
use Illuminate\Http\Request;

class PublicTeacherLinkController extends Controller
{
    private function link(string $token): TeacherLink
    {
        return TeacherLink::where('token',$token)->where('active',true)
            ->where(fn($q)=>$q->whereNull('expires_at')->orWhere('expires_at','>',now()))->firstOrFail();
    }

    public function show(string $token)
    {
        $link=$this->link($token);
        $student=$link->student()->with(['user','goals','rewards','feedback','alerts','teacherRequests'=>fn($q)=>$q->whereIn('status',['sent','viewed'])->latest()])->firstOrFail();
        $requests=$student->teacherRequests;
        $student->teacherRequests()->where('status','sent')->update(['status'=>'viewed','viewed_at'=>now()]);
        $metrics=app(ProgressService::class)->metrics($student);
        return view('teacher.public',compact('student','link','requests','metrics'));
    }

    public function store(Request $request,string $token,ProgressService $progress, EventNotificationService $notifications)
    {
        $link=$this->link($token);
        $data=$request->validate([
            'teacher_name'=>'required|max:255','teacher_email'=>'nullable|email','subject'=>'nullable|max:255',
            'engagement'=>'required','work_completion'=>'required','comment'=>'nullable','goal_progress'=>'nullable|array',
            'goal_progress.*'=>'integer|min:0|max:100'
        ]);
        $feedback = TeacherFeedback::create([
            'student_id'=>$link->student_id,'teacher_name'=>$data['teacher_name'],'teacher_email'=>$data['teacher_email']??null,
            'subject'=>$data['subject']??null,'engagement'=>$data['engagement'],'work_completion'=>$data['work_completion'],'comment'=>$data['comment']??null,
        ]);
        $notifications->feedbackSubmitted($feedback);
        foreach(($data['goal_progress']??[]) as $id=>$value){
            $goal=$link->student->goals()->whereKey($id)->first();
            if($goal) {
                $progress->updateGoal($goal,(int)$value,null,'teacher_link');
                $goal->refresh();
                $notifications->progressUpdated($goal, null);
            }
        }
        $link->student->teacherRequests()->whereIn('status',['sent','viewed'])->update(['status'=>'completed','completed_at'=>now()]);
        return back()->with('success','Feedback and goal progress submitted successfully.');
    }
}
