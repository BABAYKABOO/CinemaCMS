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

Route::get('/posters', [App\Http\Controllers\PostersController::class, 'showMovies'])->name('posters');
Route::get('/posters/{id}', [App\Http\Controllers\MovieController::class, 'showMovie'])->name('movie');

Route::get('/cinemas', [App\Http\Controllers\CinemasController::class, 'showCinemas'])->name('cinemas');

Route::get('/login', [App\Http\Controllers\AuthController::class, 'index'])->name('login');
Route::post('/login/auth', [App\Http\Controllers\AuthController::class, 'auth'])->name('auth');
Route::get('/login/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

Route::middleware([App\Http\Middleware\AuthAdmin::class])->group(function (){
    Route::prefix('admin')->group(function () {
        Route::get('/statistic', [App\Http\Controllers\StatisticController::class, 'index'])->name('statistic');

        Route::get('/banners', [App\Http\Controllers\BannersAdminController::class, 'showPage'])->name('admin-banners');
        Route::post('/banners/{id}/save', [App\Http\Controllers\BannersAdminController::class, 'save'])->name('admin-banner-save');
        Route::post('/banners/{id}/save-one', [App\Http\Controllers\BannersAdminController::class, 'saveOneBanner'])->name('admin-banner_one-save');

        Route::get('/posters', [App\Http\Controllers\PostersAdminController::class, 'showMovies'])->name('admin-posters');
        Route::get('/posters/edit/{id}', [App\Http\Controllers\MovieEdit_AdminController::class, 'showCard'])->name('admin-movie_id');
        Route::post('/posters/edit/{id}/save', [App\Http\Controllers\MovieEdit_AdminController::class, 'save'])->name('admin-movie-save');
        Route::get('/posters/edit/{id}/delete', [App\Http\Controllers\MovieEdit_AdminController::class, 'delete'])->name('admin-movie_delete');
        Route::get('/posters/add/new_movie', [App\Http\Controllers\MovieCreate_AdminController::class, 'showView'])->name('admin-movie_new');
        Route::post('/posters/add/new_movie/create', [App\Http\Controllers\MovieCreate_AdminController::class, 'create'])->name('admin-movie_create');

    });

});
