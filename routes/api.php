<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\FormController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function(){
    Route::post('login', [AuthController::class,'login']);

    Route::group(['middleware' => 'auth:sanctum'], function(){
        Route::get('logout', [AuthController::class, 'logout']);
        Route::get('form', [FormController::class, 'index']);
        Route::post('forms/create', [FormController::class,'create']);
        Route::get('forms/edit/{id}', [FormController::class, 'edit']);
        Route::post('forms/edit/{id}', [FormController::class, 'update']);
        Route::post('forms/destroy', [FormController::class, 'destroy']);
    });
});
