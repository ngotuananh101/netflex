<?php

use App\Http\Controllers\Home\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::middleware('guest')->group(function () {
    Route::prefix('auth')->group(function (){
        Route::post('register', [AuthController::class, 'register']);
        Route::post('login', [AuthController::class, 'login']);
        Route::post('forgot', [AuthController::class, 'forgot']);
        Route::post('reset', [AuthController::class, 'reset']);
    });
});

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('auth')->group(function (){
        Route::post('resend', [AuthController::class, 'resend'])->middleware('throttle:2,1');
        Route::post('verify/{id}/{hash}', [AuthController::class, 'verify']); //->middleware(['signed']); // uncomment this line if you want to use signed url
        Route::post('logout', [AuthController::class, 'logout']);
    });
    Route::resource('profile' , ProfileController::class)->only(['index', 'update']);
});
