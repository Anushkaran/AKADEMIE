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

    Route::get('dashboard',[App\Http\Controllers\Web\Partner\DashboardController::class,'index'])->name('dashboard');

});
