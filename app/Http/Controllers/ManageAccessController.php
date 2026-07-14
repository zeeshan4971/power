<?php
namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\TeacherLink;
use Illuminate\Support\Str;

class ManageAccessController extends Controller
{
    public function index(){ $children=auth()->user()->children()->with(['user','teacherLinks'=>fn($q)=>$q->where('active',true)->latest()])->get(); return view('manage.index',compact('children')); }
    public function createLink(Student $student)
    {
        abort_unless($student->parent_id===auth()->id(),403);
        $student->teacherLinks()->update(['active'=>false]);
        $link=TeacherLink::create(['student_id'=>$student->id,'token'=>Str::random(40),'expires_at'=>now()->addDays(14)]);
        return back()->with(['teacher_link'=>route('public.feedback',$link->token),'teacher_link_student'=>$student->user->name]);
    }
}
