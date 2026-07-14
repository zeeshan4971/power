<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppNotification extends Model
{
    protected $fillable = ['user_id','student_id','type','title','message','action_url','dedupe_key','read_at'];
    protected $casts = ['read_at'=>'datetime'];
    public function student(){ return $this->belongsTo(Student::class); }
}
