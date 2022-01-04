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
Route::get('/cinemas/{id}', [App\Http\Controllers\CinemaIDController::class, 'showCinema'])->name('cinema-id');
Route::get('/cinemas/{cinema_id}/{hall_id}', [App\Http\Controllers\HallController::class, 'showHall'])->name('cinema-hall');


Route::get('/discounts', [App\Http\Controllers\DiscountsController::class, 'showDiscounts'])->name('discounts');
Route::get('/discounts/{id}', [App\Http\Controllers\DiscountController::class, 'showDiscount'])->name('discount_id');


Route::get('/events', [App\Http\Controllers\EventsController::class, 'showEvents'])->name('events');


Route::get('/login', [App\Http\Controllers\AuthController::class, 'index'])->name('login');
Route::post('/login/auth', [App\Http\Controllers\AuthController::class, 'auth'])->name('auth');
Route::get('/login/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

Route::middleware([App\Http\Middleware\AuthAdmin::class])->group(function (){
    Route::prefix('admin')->group(function () {
        Route::get('/', [App\Http\Controllers\StatisticController::class, 'index'])->name('statistic');
        Route::get('/statistic', [App\Http\Controllers\StatisticController::class, 'index'])->name('statistic');


        Route::get('/banners', [App\Http\Controllers\BannersAdminController::class, 'showPage'])->name('admin-banners');
        Route::post('/banners/{id}/save', [App\Http\Controllers\BannersAdminController::class, 'save'])->name('admin-banner-save');
        Route::post('/banners/{id}/save-one', [App\Http\Controllers\BannersAdminController::class, 'saveOneBanner'])->name('admin-banner_one-save');


        Route::get('/posters', [App\Http\Controllers\PostersAdminController::class, 'showMovies'])->name('admin-posters');
        Route::get('/posters/edit/{id}', [App\Http\Controllers\MovieEdit_AdminController::class, 'showCard'])->name('admin-movie_id');
        Route::post('/posters/edit/{id}/save', [App\Http\Controllers\MovieEdit_AdminController::class, 'save'])->name('admin-movie-save');
        Route::get('/posters/edit/{id}/delete', [App\Http\Controllers\MovieEdit_AdminController::class, 'delete'])->name('admin-movie_delete');
        Route::get('/posters/add/movie_new', [App\Http\Controllers\MovieCreate_AdminController::class, 'showView'])->name('admin-movie_new');
        Route::post('/posters/add/movie_new/create', [App\Http\Controllers\MovieCreate_AdminController::class, 'create'])->name('admin-movie_create');


        Route::get('/cinemas', [App\Http\Controllers\Cinemas_AdminController::class, 'showCinemas'])->name('admin-cinemas');
        Route::get('/cinemas/add/cinema_new', [App\Http\Controllers\CinemaCreate_AdminController::class, 'showCinema'])->name('admin-cinema_new');
        Route::post('/cinemas/add/cinema_new/create', [App\Http\Controllers\CinemaCreate_AdminController::class, 'create'])->name('admin-cinema_create');

        Route::get('/cinemas/edit/{id}', [App\Http\Controllers\CinemaEdit_AdminController::class, 'showCinema'])->name('admin-cinema_id');
        Route::post('/cinemas/edit/{id}/save', [App\Http\Controllers\CinemaEdit_AdminController::class, 'save'])->name('admin-cinema_save');
        Route::get('/cinemas/edit/{cinema_id}/hall/{hall_id}', [App\Http\Controllers\HallEdit_AdminController::class, 'showHall'])->name('admin-cinema_hall-edit');
        Route::post('/cinemas/edit/{cinema_id}/hall/{hall_id}/save', [App\Http\Controllers\HallEdit_AdminController::class, 'save'])->name('admin-cinema_hall-save');
        Route::get('/cinemas/edit/{cinema_id}/hall_new/', [App\Http\Controllers\HallCreate_AdminController::class, 'showHall'])->name('admin-cinema_hall-new');
        Route::post('/cinemas/edit/{cinema_id}/hall_new/create', [App\Http\Controllers\HallCreate_AdminController::class, 'create'])->name('admin-cinema_hall-create');

        Route::get('/cinemas/edit/{cinema_id}/delete-hall_{hall_id}', [App\Http\Controllers\HallEdit_AdminController::class, 'delete'])->name('admin-cinema_hall-delete');
        Route::get('/cinemas/edit/{cinema_id}/delete', [App\Http\Controllers\CinemaEdit_AdminController::class, 'delete'])->name('admin-cinema-delete');


        Route::get('/discounts', [App\Http\Controllers\Discounts_AdminController::class, 'showDiscounts'])->name('admin-discounts');
        Route::get('/discounts/add/discount_new', [App\Http\Controllers\DiscountCreate_AdminController::class, 'showDiscount'])->name('admin-discount-new');
        Route::post('/discounts/add/discount_new/create', [App\Http\Controllers\DiscountCreate_AdminController::class, 'create'])->name('admin-discount-create');

        Route::get('/discounts/edit/{id}', [App\Http\Controllers\DiscountEdit_AdminController::class, 'showDiscount'])->name('admin-discount-edit');
        Route::post('/discounts/edit/{id}/save', [App\Http\Controllers\DiscountEdit_AdminController::class, 'save'])->name('admin-discount-save');
        Route::get('/discounts/edit/{id}/delete', [App\Http\Controllers\DiscountEdit_AdminController::class, 'delete'])->name('admin-discount-delete');


        Route::get('/events', [App\Http\Controllers\Events_AdminController::class, 'showEvents'])->name('admin-events');
        Route::get('/events/add/event_new', [App\Http\Controllers\EventCreate_AdminController::class, 'showEvent'])->name('admin-event-new');
        Route::post('/events/add/event_new/create', [App\Http\Controllers\EventCreate_AdminController::class, 'create'])->name('admin-event-create');

        Route::get('/events/edit/{id}', [App\Http\Controllers\EventEdit_AdminController::class, 'showEvent'])->name('admin-event-edit');
        Route::post('/events/edit/{id}/save', [App\Http\Controllers\EventEdit_AdminController::class, 'save'])->name('admin-event-save');
        Route::get('/events/edit/{id}/delete', [App\Http\Controllers\EventEdit_AdminController::class, 'delete'])->name('admin-event-delete');

    });

});
