<?php


use Illuminate\Support\Facades\Route;

Route::redirect('/','partner/dashboard');

Route::get('login',[\App\Http\Controllers\Web\Partner\Auth\PartnerLoginController::class,'index'])->name('login.index');
Route::post('login',[\App\Http\Controllers\Web\Partner\Auth\PartnerLoginController::class,'login'])->name('login');

Route::get('password/reset/{token}',[\App\Http\Controllers\Web\Partner\Auth\ResetPasswordController::class,'showResetForm'])->name('password.reset');
Route::post('password/reset',[\App\Http\Controllers\Web\Partner\Auth\ResetPasswordController::class,'reset'])->name('reset');

Route::get('forgot/password',[\App\Http\Controllers\Web\Partner\Auth\ForgotPasswordController::class,'showLinkRequestForm'])->name('forgot.password.email');
Route::post('forgot/password',[\App\Http\Controllers\Web\Partner\Auth\ForgotPasswordController::class,'sendResetLinkEmail'])->name('forgot.password.send');


Route::middleware('auth:partner')->group(function (){
    Route::any('logout',[\App\Http\Controllers\Web\Partner\Auth\PartnerLoginController::class,'logout'])->name('logout');
    Route::resource('students',App\Http\Controllers\Web\Partner\StudentController::class);

    Route::get('dashboard',[App\Http\Controllers\Web\Partner\DashboardController::class,'index'])->name('dashboard');


    Route::delete('evaluations/{id}/sessions/{session}',[App\Http\Controllers\Web\Partner\EvaluationController::class,'deleteSession'])->name('evaluations.sessions.delete');
    Route::post('evaluations/{id}',[App\Http\Controllers\Web\Partner\EvaluationController::class,'addSession'])->name('evaluations.sessions.store');
    Route::post('evaluations/{id}/students',[App\Http\Controllers\Web\Partner\EvaluationController::class,'attachStudents'])->name('evaluations.students.attach');
    Route::get('evaluations/{id}/students',[App\Http\Controllers\Web\Partner\EvaluationController::class,'studentsList'])->name('evaluations.students.index');
    Route::delete('evaluations/{id}/students/{student}',[App\Http\Controllers\Web\Partner\EvaluationController::class,'removeStudents'])->name('evaluations.students.remove');
    Route::get('evaluations/{id}/skills',[App\Http\Controllers\Web\Partner\EvaluationController::class,'skillsList'])->name('evaluations.skills.index');
    Route::post('evaluations/{id}/skills',[App\Http\Controllers\Web\Partner\EvaluationController::class,'attachSkills'])->name('evaluations.skills.attach');
    Route::delete('evaluations/{id}/skills/{skill}',[App\Http\Controllers\Web\Partner\EvaluationController::class,'removeSkills'])->name('evaluations.skills.remove');
    Route::resource('evaluations',App\Http\Controllers\Web\Partner\EvaluationController::class);

    Route::get('centers',[App\Http\Controllers\Web\Partner\CenterController::class,'index'])->name('centers.index');
    Route::get('users',[App\Http\Controllers\Web\Partner\UserController::class,'index'])->name('users.index');
    Route::get('skills',[App\Http\Controllers\Web\Partner\SkillController::class,'index'])->name('skills.index');

});
