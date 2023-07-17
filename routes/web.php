<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '.*');

Route::get('auth/verify/{id}/{hash}', function () {
    return view('welcome');
})->name('verification.verify')->middleware('signed');

Route::get('auth/reset/{token}', function () {
    return view('welcome');
})->name('password.reset')->middleware('signed');
