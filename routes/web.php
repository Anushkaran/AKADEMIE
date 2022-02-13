<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Route::get('login', [\App\Http\Controllers\Web\User\Auth\UserLoginController::class, 'index'])->name('login.index');
Route::post('login', [\App\Http\Controllers\Web\User\Auth\UserLoginController::class, 'login'])->name('login');

Route::get('password/reset/{token}', [\App\Http\Controllers\Web\User\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [\App\Http\Controllers\Web\User\Auth\ResetPasswordController::class, 'reset'])->name('reset');

Route::get('forgot/password', [\App\Http\Controllers\Web\User\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('forgot.password.email');
Route::post('forgot/password', [\App\Http\Controllers\Web\User\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('forgot.password.send');


Route::middleware('auth')->group(function () {
    Route::any('logout', [\App\Http\Controllers\Web\User\Auth\UserLoginController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [App\Http\Controllers\Web\User\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/evaluation-sessions', [App\Http\Controllers\Web\User\EvaluationSessionController::class, 'index'])->name('evaluation-sessions.index');
    Route::get('/preview/{id}', [App\Http\Controllers\Web\User\DashboardController::class, 'preview'])->name('resources.preview');
    Route::get('/download/{id}', [App\Http\Controllers\Web\User\DashboardController::class, 'fileDownload'])->name('resources.fileDownload');
    Route::get('/files/{id}', [App\Http\Controllers\Web\User\DashboardController::class, 'getFile'])->name('file');
});


Route::view('/', 'welcome');
Route::view('/pdf-view', 'user.evaluation-sessions.absence-sheet');


Route::get('migrate',[App\Http\Controllers\ArtisanController::class,'migrate']);
Route::get('seed',[App\Http\Controllers\ArtisanController::class,'seed']);
Route::get('storage',[App\Http\Controllers\ArtisanController::class,'storage']);
Route::get('cache',[App\Http\Controllers\ArtisanController::class,'cache']);
