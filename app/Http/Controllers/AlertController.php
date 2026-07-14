<?php
namespace App\Http\Controllers;
use App\Models\Alert;
class AlertController extends Controller { public function index(){ $student=$this->currentStudent(); return view('alerts.index',compact('student')); } public function resolve(Alert $alert){$alert->update(['status'=>'resolved','resolved_at'=>now()]); return back();} }
