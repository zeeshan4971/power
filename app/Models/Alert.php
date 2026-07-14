<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Alert extends Model { protected $fillable=['student_id','type','title','description','priority','status','resolved_at']; protected $casts=['resolved_at'=>'datetime']; public function student(){return $this->belongsTo(Student::class);} }
