<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoalProgressLog extends Model
{
    protected $fillable = ['goal_id','student_id','updated_by','progress','source'];
    public function goal(){ return $this->belongsTo(Goal::class); }
    public function student(){ return $this->belongsTo(Student::class); }
}
