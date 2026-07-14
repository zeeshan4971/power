<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'user_id', 'parent_id', 'age', 'grade', 'school', 'avatar_url',
        'strengths', 'watch_areas', 'parent_notes',
    ];

    public function user(){ return $this->belongsTo(User::class); }
    public function parent(){ return $this->belongsTo(User::class, 'parent_id'); }
    public function goals(){ return $this->hasMany(Goal::class); }
    public function rewards(){ return $this->hasMany(Reward::class); }
    public function feedback(){ return $this->hasMany(TeacherFeedback::class); }
    public function alerts(){ return $this->hasMany(Alert::class); }
    public function teacherRequests(){ return $this->hasMany(TeacherRequest::class); }
    public function teacherLinks(){ return $this->hasMany(TeacherLink::class); }
    public function progressLogs(){ return $this->hasMany(GoalProgressLog::class); }
}
