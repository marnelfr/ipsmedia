<?php

use App\Http\Controllers\V1\Auth\LoginController;
use App\Http\Controllers\V1\Auth\RegisterController;
use App\Http\Controllers\V1\HomeController;
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

Route::get('/', HomeController::class)->name('home');

Route::post('register', [RegisterController::class, 'create'])->name('register');
Route::post('login', [LoginController::class, 'create'])->name('login');
Route::post('logout', [LoginController::class, 'destroy'])->name('logout');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
