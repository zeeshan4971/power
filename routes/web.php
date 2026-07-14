<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController; use App\Http\Controllers\DashboardController; use App\Http\Controllers\StudentController; use App\Http\Controllers\GoalController; use App\Http\Controllers\RewardController; use App\Http\Controllers\TeacherFeedbackController; use App\Http\Controllers\AlertController; use App\Http\Controllers\ReportController; use App\Http\Controllers\ManageAccessController; use App\Http\Controllers\PublicTeacherLinkController; use App\Http\Controllers\ProfileController; use App\Http\Controllers\NotificationController; use App\Http\Controllers\OnboardingController;
Route::get('/', fn()=>redirect()->route('login'));
Route::get('/login',[AuthController::class,'login'])->name('login'); Route::post('/login',[AuthController::class,'doLogin']);
Route::get('/register',[AuthController::class,'register'])->name('register'); Route::post('/register',[AuthController::class,'doRegister']); Route::post('/logout',[AuthController::class,'logout'])->name('logout');
Route::get('/feedback/{token}',[PublicTeacherLinkController::class,'show'])->name('public.feedback'); Route::post('/feedback/{token}',[PublicTeacherLinkController::class,'store']);
Route::middleware('auth')->group(function(){
 Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
 Route::post('/onboarding/progress',[OnboardingController::class,'progress'])->name('onboarding.progress');
 Route::post('/onboarding/complete',[OnboardingController::class,'complete'])->name('onboarding.complete');
 Route::post('/onboarding/restart',[OnboardingController::class,'restart'])->name('onboarding.restart');
 Route::get('/notifications/feed',[NotificationController::class,'index'])->name('notifications.feed');
 Route::get('/notifications/{notification}/open',[NotificationController::class,'open'])->name('notifications.open');
 Route::post('/notifications/read-all',[NotificationController::class,'readAll'])->name('notifications.read-all');
 Route::get('/profile',[ProfileController::class,'edit'])->name('profile.edit');
 Route::put('/profile',[ProfileController::class,'update'])->name('profile.update');
 Route::get('/students/{student}/edit',[StudentController::class,'edit'])->name('students.edit'); Route::put('/students/{student}',[StudentController::class,'update'])->name('students.update'); Route::post('/students',[StudentController::class,'store'])->name('students.store'); Route::delete('/students/{student}',[StudentController::class,'destroy'])->name('students.destroy');
 Route::resource('goals',GoalController::class)->except(['show','edit','create']); Route::post('/goals/{goal}/progress',[GoalController::class,'progress'])->name('goals.progress');
 Route::resource('rewards',RewardController::class)->except(['show','edit','create']);
 Route::get('/teacher-feedback',[TeacherFeedbackController::class,'index'])->name('teacher-feedback'); Route::post('/teacher-feedback/request',[TeacherFeedbackController::class,'requestCheckin'])->name('teacher.request'); Route::post('/teacher-feedback',[TeacherFeedbackController::class,'store'])->name('teacher-feedback.store');
 Route::get('/alerts',[AlertController::class,'index'])->name('alerts'); Route::post('/alerts/{alert}/resolve',[AlertController::class,'resolve'])->name('alerts.resolve');
 Route::get('/reports',[ReportController::class,'index'])->name('reports');
 Route::get('/manage-access',[ManageAccessController::class,'index'])->name('manage-access'); Route::post('/manage-access/link/{student}',[ManageAccessController::class,'createLink'])->name('manage.link');
});
