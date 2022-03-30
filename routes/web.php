<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\admin\AboutUsImageController;
use App\Http\Controllers\Admin\AddressController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\CruiseController as AdminCruiseController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HeaderImageController;
use App\Http\Controllers\Admin\HomeImagesController;
use App\Http\Controllers\Admin\LegitimacyImagesController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\PromoController as AdminPromoController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\TourController as AdminTourController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\CruiseController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\WelcomeController;
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

Route::get('/', WelcomeController::class)->name('welcome');

Route::get('/booking', [BookingController::class, 'index'])->name('booking');
Route::get('/booking/detail/{booking}', [BookingController::class, 'show'])->name('booking.show');
Route::post('/booking/detail/{booking}/inquire', [BookingController::class, 'inquire'])->name('booking.inquire');

Route::get('/tour', [TourController::class, 'index'])->name('tour');
Route::get('/tour/detail/{tour}', [TourController::class, 'show'])->name('tour.show');
Route::get('/tour/inquire/{tour}', [TourController::class, 'inquire'])->name('tour.inquire');
Route::post('/tour/detail/{tour}/book', [TourController::class, 'mail'])->name('tour.mail');

Route::get('/cruise', [CruiseController::class, 'index'])->name('cruise');
Route::get('/cruise/detail/{cruise}', [CruiseController::class, 'show'])->name('cruise.show');
Route::get('/cruise/inquire/{cruise}', [CruiseController::class, 'inquire'])->name('cruise.inquire');
Route::post('/cruise/detail/{cruise}/book', [CruiseController::class, 'mail'])->name('cruise.mail');

Route::get('/promo', [PromoController::class, 'index'])->name('promo');
Route::get('/promo/detail/{promo}', [PromoController::class, 'show'])->name('promo.show');
Route::get('/promo/inquire/{promo}', [PromoController::class, 'inquire'])->name('promo.inquire');
Route::post('/promo/detail/{promo}/book', [PromoController::class, 'mail'])->name('promo.mail');

Route::get('/news', [NewsController::class, 'index'])->name('news');
Route::get('/news/detail/{news}', [NewsController::class, 'show'])->name('news.show');

Route::get('/contact-us', [ContactUsController::class, 'index'])->name('contactus');
Route::post('/contact-us/mail', [ContactUsController::class, 'mail'])->name('contactus.mail');

Route::get('/about-us', AboutUsController::class)->name('aboutus');

Route::middleware(['auth'])->prefix('admin')->group(function() {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::prefix('company')->group(function () {
        Route::resource('/address', AddressController::class, ['as' => 'admin']);
        Route::resource('/contact', ContactController::class, ['as' => 'admin']);
    });

    Route::prefix('images')->group(function () {
        Route::resource('/home', HomeImagesController::class, ['as' => 'admin.images'])
             ->except(['show']);
        Route::resource('/legitimacy', LegitimacyImagesController::class, ['as' => 'admin.images'])
             ->only(['index', 'store', 'destroy']);
        Route::resource('/backgrounds/header', HeaderImageController::class, ['as' => 'admin.images.backgrounds'])
             ->only(['index', 'store']);
        Route::resource('/backgrounds/aboutus', AboutUsImageController::class, ['as' => 'admin.images.backgrounds'])
             ->only(['index', 'store']);
    });

    Route::resource('/booking', AdminBookingController::class, ['as' => 'admin'])->except(['show']);
    Route::get('/booking/upload', [AdminBookingController::class, 'upload'])->name('admin.booking.upload');
    Route::post('/booking/import', [AdminBookingController::class, 'import'])->name('admin.booking.import');
    Route::resource('/tour', AdminTourController::class, ['as' => 'admin']);
    Route::resource('/cruise', AdminCruiseController::class, ['as' => 'admin']);
    Route::resource('/promo', AdminPromoController::class, ['as' => 'admin']);
    Route::resource('/news', AdminNewsController::class, ['as' => 'admin']);
    Route::resource('/testimonial', TestimonialController::class, ['as' => 'admin']);
});

Route::get('/search', SearchController::class)->name('search');

require __DIR__.'/auth.php';
