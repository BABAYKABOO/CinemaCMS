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

Route::get('/', [App\Http\Controllers\MainController::class, 'index'])->name('main');
Route::get('/login', [App\Http\Controllers\AuthController::class, 'index'])->name('login');
Route::get('/login/auth', [App\Http\Controllers\AuthController::class, 'auth'])->name('auth');
Route::get('/login/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

Route::middleware([App\Http\Middleware\AuthAdmin::class])->group(function (){
    Route::get('/statistic', [App\Http\Controllers\StatisticController::class, 'index'])->name('statistic');
});
