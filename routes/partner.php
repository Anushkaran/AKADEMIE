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

    Route::middleware('activeAccount')->group(function (){
        Route::resource('students',App\Http\Controllers\Web\Partner\StudentController::class);
        Route::get('dashboard',[App\Http\Controllers\Web\Partner\DashboardController::class,'index'])->name('dashboard');
        Route::get('tasks',[App\Http\Controllers\Web\Partner\SkillController::class,'getTasks'])->name('tasks.index');
        Route::delete('evaluations/{id}/sessions/{session}',[App\Http\Controllers\Web\Partner\EvaluationController::class,'deleteSession'])->name('evaluations.sessions.delete');
        Route::post('evaluations/{id}/students',[App\Http\Controllers\Web\Partner\EvaluationController::class,'attachStudents'])->name('evaluations.students.attach');
        Route::get('evaluations/{id}/students',[App\Http\Controllers\Web\Partner\EvaluationController::class,'studentsList'])->name('evaluations.students.index');
        Route::get('evaluations/{id}/students/{student}',[App\Http\Controllers\Web\Partner\EvaluationController::class,'studentDetails'])->name('evaluations.students.show');
        Route::delete('evaluations/{id}/students/{student}',[App\Http\Controllers\Web\Partner\EvaluationController::class,'removeStudents'])->name('evaluations.students.remove');
        Route::put('evaluations/{id}/students/{student}/enable',[App\Http\Controllers\Web\Partner\EvaluationController::class,'disableStudent'])->name('evaluations.students.disable');
        Route::put('evaluations/{id}/students/{student}/disable',[App\Http\Controllers\Web\Partner\EvaluationController::class,'enableStudent'])->name('evaluations.students.enable');

        Route::post('evaluations/{evaluation}/sessions/{session}/tasks',[App\Http\Controllers\Web\Partner\EvaluationSessionController::class,'attachTask'])->name('evaluations.sessions.tasks.attach');
        Route::delete('evaluations/{evaluation}/sessions/{session}/tasks/{task}',[App\Http\Controllers\Web\Partner\EvaluationSessionController::class,'detachTask'])->name('evaluations.sessions.tasks.detach');
        Route::post('evaluations/{evaluation}/sessions/{session}/users',[App\Http\Controllers\Web\Partner\EvaluationSessionController::class,'attachUser'])->name('evaluations.sessions.users.attach');
        Route::delete('evaluations/{evaluation}/sessions/{session}/users/{user}',[App\Http\Controllers\Web\Partner\EvaluationSessionController::class,'detachUser'])->name('evaluations.sessions.users.detach');
        Route::resource('evaluations.sessions',App\Http\Controllers\Web\Partner\EvaluationSessionController::class);
        Route::resource('evaluations',App\Http\Controllers\Web\Partner\EvaluationController::class);
        Route::get('centers',[App\Http\Controllers\Web\Partner\CenterController::class,'index'])->name('centers.index');
        Route::get('users',[App\Http\Controllers\Web\Partner\UserController::class,'index'])->name('users.index');
        Route::get('skills',[App\Http\Controllers\Web\Partner\SkillController::class,'index'])->name('skills.index');

        Route::get('/settings', [App\Http\Controllers\Web\Partner\SettingSheetController::class,'index'])->name('settings.absence-sheet.index');
        Route::post('/settings', [App\Http\Controllers\Web\Partner\SettingSheetController::class,'store'])->name('settings.absence-sheet.store');

    });

    Route::view('un-active/account','partner.account.un-active')
        ->name('un-active.account')
        ->middleware('unActiveAccount');


});

