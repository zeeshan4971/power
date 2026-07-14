<?php
namespace App\Http\Controllers;

use App\Models\TeacherFeedback;
use App\Models\TeacherLink;
use App\Models\TeacherRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Services\EventNotificationService;

class TeacherFeedbackController extends Controller
{
    public function index(){ $student=$this->currentStudent(); return view('teacher.index',compact('student')); }
    public function store(Request $request, EventNotificationService $notifications)
    {
        $data = $request->validate([
            'student_id' => 'required|exists:students,id',
            'teacher_name' => 'required',
            'subject' => 'nullable',
            'engagement' => 'nullable',
            'work_completion' => 'nullable',
            'comment' => 'nullable',
            'teacher_request_id' => 'nullable|exists:teacher_requests,id',
        ]);
        $requestId = $data['teacher_request_id'] ?? null;
        unset($data['teacher_request_id']);

        $feedback = TeacherFeedback::create($data);

        if ($requestId) {
            TeacherRequest::whereKey($requestId)->update([
                'status' => 'completed',
                'completed_at' => now(),
            ]);
        }

        $notifications->feedbackSubmitted($feedback);
        return back()->with('success', 'Feedback saved');
    }
    public function requestCheckin(Request $request, EventNotificationService $notifications)
    {
        $data=$request->validate(['student_id'=>'required|exists:students,id','teacher_name'=>'required','teacher_email'=>'nullable|email','message'=>'nullable','urgency'=>'required|in:normal,urgent']);
        $student=auth()->user()->children()->findOrFail($data['student_id']);
        $link=$student->teacherLinks()->where('active',true)->where(fn($q)=>$q->whereNull('expires_at')->orWhere('expires_at','>',now()))->latest()->first();
        if(!$link) $link=TeacherLink::create(['student_id'=>$student->id,'token'=>Str::random(40),'expires_at'=>now()->addDays(14)]);
        $teacherRequest=TeacherRequest::create($data+['parent_id'=>auth()->id(),'teacher_link_id'=>$link->id,'status'=>'sent']);
        $notifications->checkInRequested($teacherRequest);
        if(!empty($data['teacher_email'])){
            $url=route('public.feedback',$link->token);
            try {
                Mail::raw(($data['message']?:'A new student progress check-in has been requested.')."\n\nOpen the teacher dashboard: {$url}", function($mail) use($data,$student){$mail->to($data['teacher_email'])->subject('PowerGuard check-in request for '.$student->user->name);});
            } catch (\Throwable $e) {
                report($e);
            }
        }
        return back()->with(['success'=>'Teacher request sent.','teacher_link'=>route('public.feedback',$link->token)]);
    }
}
