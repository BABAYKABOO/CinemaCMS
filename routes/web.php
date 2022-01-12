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

Route::get('/timetables', [App\Http\Controllers\Timetables_Controller::class, 'showTimetables'])->name('timetables');
Route::middleware([App\Http\Middleware\AuthUser::class])->group(function (){
    Route::get('/timetables/{id}/book', [App\Http\Controllers\Book_Controller::class, 'showBook'])->name('book');
    Route::post('/timetables/{id}/book/booking', [App\Http\Controllers\Book_Controller::class, 'book'])->name('timetable-book');
});

Route::get('/soon', [App\Http\Controllers\SoonController::class, 'showMovies'])->name('soon');
Route::get('/soon/{id}', [App\Http\Controllers\MovieController::class, 'showMovie'])->name('soon_movie');

Route::get('/cinemas', [App\Http\Controllers\CinemasController::class, 'showCinemas'])->name('cinemas');
Route::get('/cinemas/{id}', [App\Http\Controllers\CinemaIDController::class, 'showCinema'])->name('cinema-id');
Route::get('/cinemas/{cinema_id}/{hall_id}', [App\Http\Controllers\HallController::class, 'showHall'])->name('cinema-hall');


Route::get('/discounts', [App\Http\Controllers\DiscountsController::class, 'showDiscounts'])->name('discounts');
Route::get('/discounts/{id}', [App\Http\Controllers\DiscountController::class, 'showDiscount'])->name('discount_id');


Route::get('/pages/{id}', [App\Http\Controllers\PageStatic_Controller::class, 'showPage'])->name('page_id');
Route::get('/events', [App\Http\Controllers\EventsController::class, 'showEvents'])->name('events');
Route::get('/mobile', [App\Http\Controllers\PageMobile_Controller::class, 'showPage'])->name('page_mobile');
Route::get('/cafe-bar', [App\Http\Controllers\PageCafe_Controller::class, 'showPage'])->name('page_cafe');
Route::get('/contacts', [App\Http\Controllers\Contacts_Controller::class, 'showContacts'])->name('page_contacts');


Route::get('/admin/login', [App\Http\Controllers\AuthController::class, 'admin_index'])->name('login');
Route::post('/admin/login/auth', [App\Http\Controllers\AuthController::class, 'admin_auth'])->name('auth');
Route::get('/admin/login/logout', [App\Http\Controllers\AuthController::class, 'admin_logout'])->name('logout');

Route::get('/user/login', [App\Http\Controllers\AuthController::class, 'user_index'])->name('user-login');
Route::post('/user/login/auth', [App\Http\Controllers\AuthController::class, 'user_auth'])->name('user-auth');
Route::get('/user/login/logout', [App\Http\Controllers\AuthController::class, 'user_logout'])->name('user-logout');

Route::get('/user/registration', [App\Http\Controllers\AuthController::class, 'user_index_reg'])->name('user_registration');
Route::post('/user/registration/reg', [App\Http\Controllers\AuthController::class, 'user_reg'])->name('user-reg');

Route::middleware([App\Http\Middleware\AuthAdmin::class])->group(function (){
    Route::prefix('admin')->group(function () {
        Route::get('/', [App\Http\Controllers\StatisticController::class, 'index'])->name('statistic');
        Route::get('/statistic', [App\Http\Controllers\StatisticController::class, 'index'])->name('statistic');


        Route::get('/banners', [App\Http\Controllers\Banners_AdminController::class, 'showPage'])->name('admin-banners');
        Route::post('/banners/{id}/save', [App\Http\Controllers\Banners_AdminController::class, 'save'])->name('admin-banner-save');
        Route::post('/banners/{id}/save-one', [App\Http\Controllers\Banners_AdminController::class, 'saveOneBanner'])->name('admin-banner_one-save');


        Route::get('/posters', [App\Http\Controllers\Posters_AdminController::class, 'showMovies'])->name('admin-posters');
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


        Route::get('/timetables', [App\Http\Controllers\Timetables_AdminController::class, 'showTimetables'])->name('admin-timetables');
        Route::get('/timetables/add/new', [App\Http\Controllers\TimetablesCreate_AdminController::class, 'showTimetable'])->name('admin-timetable-new');
        Route::post('/timetables/add/new/create', [App\Http\Controllers\TimetablesCreate_AdminController::class, 'create'])->name('admin-timetable-create');

        Route::get('/timetables/edit/{id}', [App\Http\Controllers\TimetablesEdit_AdminController::class, 'showTimetable'])->name('admin-timetable-edit');
        Route::post('/timetables/edit/{id}/save', [App\Http\Controllers\TimetablesEdit_AdminController::class, 'save'])->name('admin-timetable-save');
        Route::get('/timetables/edit/{id}/delete', [App\Http\Controllers\TimetablesEdit_AdminController::class, 'delete'])->name('admin-timetable-delete');


        Route::get('/pages', [App\Http\Controllers\Pages_AdminController::class, 'showPages'])->name('admin-pages');

        Route::get('/pages/new_page', [App\Http\Controllers\PageCreate_AdminController::class, 'showPage'])->name('admin-page-new');
        Route::post('/pages/new_page/create', [App\Http\Controllers\PageCreate_AdminController::class, 'create'])->name('admin-page_id-create');

        Route::get('/pages/{id}/edit', [App\Http\Controllers\PageEdit_AdminController::class, 'showPage'])->name('admin-page_id-edit');
        Route::post('/pages/{id}/edit/save', [App\Http\Controllers\PageEdit_AdminController::class, 'save'])->name('admin-page_id-save');
        Route::post('/pages/{id}/edit/delete', [App\Http\Controllers\PageEdit_AdminController::class, 'delete'])->name('admin-page_id-delete');

        Route::get('/contacts/edit', [App\Http\Controllers\Contacts_AdminController::class, 'showContacts'])->name('admin-contacts-edit');
        Route::post('/contacts/save', [App\Http\Controllers\Contacts_AdminController::class, 'save'])->name('admin-contacts-save');

        Route::get('/pages/main', [App\Http\Controllers\Main_AdminController::class, 'showPage'])->name('admin-page_main-edit');
        Route::post('/pages/main/save', [App\Http\Controllers\Main_AdminController::class, 'save'])->name('admin-page_main-save');

        Route::get('/users', [App\Http\Controllers\Users_AdminController::class, 'showUsers'])->name('admin-users');
        Route::get('/users/edit/{id}', [App\Http\Controllers\UserEdit_AdminController::class, 'showUser'])->name('admin-user-edit');
        Route::post('/users/edit/{id}/save', [App\Http\Controllers\UserEdit_AdminController::class, 'showUser'])->name('admin-user-save');
        Route::get('/users/edit/{id}/delete', [App\Http\Controllers\UserEdit_AdminController::class, 'delete'])->name('admin-user-delete');


        Route::get('/send_methods', [App\Http\Controllers\Send_AdminController::class, 'showSendMethods'])->name('admin-send_methods');

    });

});
