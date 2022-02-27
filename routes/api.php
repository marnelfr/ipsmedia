<?php

use App\Http\Controllers\V1\Auth\LoginController;
use App\Http\Controllers\V1\Auth\RegisterController;
use App\Http\Controllers\V1\CommentsController;
use App\Http\Controllers\V1\HomeController;
use App\Http\Controllers\V1\LessonUserController;
use App\Http\Controllers\V1\UserController;
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

Route::get('/', HomeController::class)->name('home');

Route::post('register', [RegisterController::class, 'create'])->name('register');
Route::post('login', [LoginController::class, 'create'])->name('login');
Route::post('logout', [LoginController::class, 'destroy'])->name('logout');

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('user', UserController::class);
    Route::post('comment', [CommentsController::class, 'create'])->name('comment.create');
    Route::post('watched', [LessonUserController::class, 'create']);
});
