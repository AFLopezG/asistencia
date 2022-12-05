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

Route::post('login', [\App\Http\Controllers\UserController::class, 'login']);
Route::group(['middleware'=>'auth:sanctum'],function (){
    Route::post('me', [\App\Http\Controllers\UserController::class, 'me']);
    Route::post('logout', [\App\Http\Controllers\UserController::class, 'logout']);
    Route::put('updatePassword/{user}', [\App\Http\Controllers\UserController::class, 'updatePassword']);

    Route::apiResource('user', \App\Http\Controllers\UserController::class);
    Route::apiResource('personal', \App\Http\Controllers\PersonalController::class);

});

