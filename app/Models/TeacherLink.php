<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class TeacherLink extends Model { protected $fillable=['student_id','token','active','expires_at']; protected $casts=['active'=>'boolean','expires_at'=>'datetime']; public function student(){return $this->belongsTo(Student::class);} }
