<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/','admin/dashboard');

Route::get('login',[\App\Http\Controllers\Web\Admin\Auth\AdminLoginController::class,'index'])->name('login.index');
Route::post('login',[\App\Http\Controllers\Web\Admin\Auth\AdminLoginController::class,'login'])->name('login');

Route::get('password/reset/{token}',[\App\Http\Controllers\Web\Admin\Auth\ResetPasswordController::class,'showResetForm'])->name('password.reset');
Route::post('password/reset',[\App\Http\Controllers\Web\Admin\Auth\ResetPasswordController::class,'reset'])->name('reset');

Route::get('forgot/password',[\App\Http\Controllers\Web\Admin\Auth\ForgotPasswordController::class,'showLinkRequestForm'])->name('forgot.password.email');
Route::post('forgot/password',[\App\Http\Controllers\Web\Admin\Auth\ForgotPasswordController::class,'sendResetLinkEmail'])->name('forgot.password.send');



Route::middleware('auth:admin')->group(function (){
    Route::any('logout',[\App\Http\Controllers\Web\Admin\Auth\AdminLoginController::class,'logout'])->name('logout');

    Route::get('dashboard',[App\Http\Controllers\Web\Admin\DashboardController::class,'index'])->name('dashboard');

    Route::get('users/{id}/edit-password',[App\Http\Controllers\Web\Admin\UserController::class,'editPassword'])->name('users.password.edit');
    Route::put('users/{id}/edit-password',[App\Http\Controllers\Web\Admin\UserController::class,'updatePassword'])->name('users.password.update');
    Route::resource('users',App\Http\Controllers\Web\Admin\UserController::class);

    Route::get('partners/{id}/edit-password',[App\Http\Controllers\Web\Admin\PartnerController::class,'editPassword'])->name('partners.password.edit');
    Route::put('partners/{id}/edit-password',[App\Http\Controllers\Web\Admin\PartnerController::class,'updatePassword'])->name('partners.password.update');
    Route::resource('partners',App\Http\Controllers\Web\Admin\PartnerController::class);

    Route::get('admins/{id}/edit-password',[App\Http\Controllers\Web\Admin\AdminController::class,'editPassword'])->name('admins.password.edit');
    Route::put('admins/{id}/edit-password',[App\Http\Controllers\Web\Admin\AdminController::class,'updatePassword'])->name('admins.password.update');
    Route::resource('admins',App\Http\Controllers\Web\Admin\AdminController::class);

    Route::resource('centers',App\Http\Controllers\Web\Admin\CenterController::class);
    Route::resource('students',App\Http\Controllers\Web\Admin\StudentController::class);

    Route::post('evaluations/{id}',[App\Http\Controllers\Web\Admin\EvaluationController::class,'addSession'])->name('evaluations.sessions.store');
    Route::delete('evaluations/{id}/sessions/{session}',[App\Http\Controllers\Web\Admin\EvaluationController::class,'deleteSession'])->name('evaluations.sessions.delete');
    Route::get('evaluations/{id}/students',[App\Http\Controllers\Web\Admin\EvaluationController::class,'studentsList'])->name('evaluations.students.index');
    Route::post('evaluations/{id}/students',[App\Http\Controllers\Web\Admin\EvaluationController::class,'attachStudents'])->name('evaluations.students.attach');
    Route::put('evaluations/{id}/students/{student}/enable',[App\Http\Controllers\Web\Admin\EvaluationController::class,'disableStudent'])->name('evaluations.students.disable');
    Route::put('evaluations/{id}/students/{student}/disable',[App\Http\Controllers\Web\Admin\EvaluationController::class,'enableStudent'])->name('evaluations.students.enable');
    Route::delete('evaluations/{id}/students/{student}',[App\Http\Controllers\Web\Admin\EvaluationController::class,'removeStudents'])->name('evaluations.students.remove');
    Route::get('evaluations/{id}/skills',[App\Http\Controllers\Web\Admin\EvaluationController::class,'skillsList'])->name('evaluations.skills.index');
    Route::post('evaluations/{id}/skills',[App\Http\Controllers\Web\Admin\EvaluationController::class,'attachSkills'])->name('evaluations.skills.attach');
    Route::delete('evaluations/{id}/skills/{skill}',[App\Http\Controllers\Web\Admin\EvaluationController::class,'removeSkills'])->name('evaluations.skills.remove');
    Route::resource('evaluations',App\Http\Controllers\Web\Admin\EvaluationController::class);


    Route::post('skills/{id}/tasks',[App\Http\Controllers\Web\Admin\SkillController::class,'taskStore'])->name('skills.tasks.store');
    Route::resource('skills',App\Http\Controllers\Web\Admin\SkillController::class);
    Route::resource('tasks',App\Http\Controllers\Web\Admin\TaskController::class);
});
