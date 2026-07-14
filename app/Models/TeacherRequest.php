<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class TeacherRequest extends Model {
    protected $fillable=['student_id','teacher_link_id','parent_id','teacher_name','teacher_email','message','urgency','status','viewed_at','completed_at'];
    protected $casts=['viewed_at'=>'datetime','completed_at'=>'datetime'];
    public function student(){return $this->belongsTo(Student::class);}
    public function link(){return $this->belongsTo(TeacherLink::class,'teacher_link_id');}
}
