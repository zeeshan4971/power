<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Reward extends Model { protected $fillable=['student_id','name','condition','category','progress','status','earned_at']; protected $casts=['earned_at'=>'datetime']; public function student(){return $this->belongsTo(Student::class);} }
