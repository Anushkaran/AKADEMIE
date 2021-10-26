<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::post('login',[\App\Http\Controllers\Api\UserAuthController::class,'login']);
Route::any('logout',[\App\Http\Controllers\Api\UserAuthController::class,'logout']);
Route::get('me',[\App\Http\Controllers\Api\UserAuthController::class,'me']);


Route::middleware('auth:sanctum')->group(function () {
    Route::get('evaluations',[\App\Http\Controllers\Api\EvaluationController::class,'index']);
    Route::get('evaluations/{id}/sessions',[\App\Http\Controllers\Api\EvaluationController::class,'getSessions']);
    Route::get('evaluations/{id}/sessions/{session}/students',[\App\Http\Controllers\Api\EvaluationController::class,'students']);
    //Route::get('evaluations/{id}/students',[\App\Http\Controllers\Api\EvaluationController::class,'students']);
    Route::get('evaluations/{id}/sessions/{session}/students/{student}',[\App\Http\Controllers\Api\StudentController::class,'show']);
    Route::get('evaluations/{id}/skills',[\App\Http\Controllers\Api\EvaluationController::class,'skills']);
    Route::get('sessions/{session}/students/{student}',[\App\Http\Controllers\Api\StudentController::class,'startSession']);
    Route::get('sessions/{session}/tasks',[\App\Http\Controllers\Api\EvaluationController::class,'tasks']);
    Route::post('session-student/{session_student}/attach/task',[\App\Http\Controllers\Api\StudentController::class,'attachTask']);
    Route::post('session-student/{session_student}/detach/task',[\App\Http\Controllers\Api\StudentController::class,'detachTask']);
    Route::put('session-student/{session_student}/update/note',[\App\Http\Controllers\Api\StudentController::class,'updateNote']);
});
