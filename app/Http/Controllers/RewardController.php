<?php
namespace App\Http\Controllers;

use App\Models\Reward;
use App\Services\ProgressService;
use Illuminate\Http\Request;

class RewardController extends Controller
{
    public function index(){ $student=$this->currentStudent(); return view('rewards.index',compact('student')); }
    public function store(Request $request, ProgressService $progress){
        $data=$request->validate(['student_id'=>'required|exists:students,id','name'=>'required','condition'=>'nullable','category'=>'required|in:Food,Gaming,Experience']);
        $student=auth()->user()->children()->findOrFail($data['student_id']);
        Reward::create($data+['progress'=>0,'status'=>'locked']);
        $progress->recalculateRewards($student);
        return back()->with('success','Reward created');
    }
    public function update(Request $request,Reward $reward){$reward->update($request->validate(['name'=>'required','condition'=>'nullable','category'=>'required|in:Food,Gaming,Experience','progress'=>'integer|min:0|max:100','status'=>'nullable'])); return back();}
    public function destroy(Reward $reward){$reward->delete(); return back();}
}
