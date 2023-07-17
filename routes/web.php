<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
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
// Route to help vuejs handle the routes
Route::get('storage/{filename}', function ($filename) {
    $path = storage_path('app/public/' . $filename);
    if (!File::exists($path)) {
        abort(404);
    }
    $file = File::get($path);
    $type = File::mimeType($path);
    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);
    return $response;
})->where('filename', '.*');

// Let vuejs handle the routes
Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '.*');

// Route to handle the email verification
Route::get('auth/verify/{id}/{hash}', function () {
    return view('welcome');
})->name('verification.verify')->middleware('signed');
// Route to handle the password reset
Route::get('auth/reset/{token}', function () {
    return view('welcome');
})->name('password.reset')->middleware('signed');
