<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Goal extends Model {
    protected $fillable=['student_id','created_by','title','category','target','success_criteria','due_date','progress','last_progress_at','status'];
    protected $casts=['due_date'=>'date','last_progress_at'=>'datetime'];
    public function student(){return $this->belongsTo(Student::class);}
    public function logs(){return $this->hasMany(GoalProgressLog::class);}
}
