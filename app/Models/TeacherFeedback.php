<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class TeacherFeedback extends Model { protected $table='teacher_feedback'; protected $fillable=['student_id','teacher_name','teacher_email','subject','engagement','work_completion','comment']; public function student(){return $this->belongsTo(Student::class);} }
