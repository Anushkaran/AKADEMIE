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
    Route::get('evaluations/{id}/students',[\App\Http\Controllers\Api\EvaluationController::class,'students']);
    Route::get('evaluations/{id}/skills',[\App\Http\Controllers\Api\EvaluationController::class,'skills']);
});
