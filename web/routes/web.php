<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\OfferController;

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



Route::get('language/{locale}', function ($locale) {
    //app()->setLocale($locale);
    if( in_array($locale,['en','ar']) )
    {
        session()->put('locale', $locale);
    }

    return redirect()->back();
})->name('language');

/*************************/

Route::get('/master', function () {
    return view('layouts.master');
})->name('master');


Route::get('/', [HomeController::class,'index'])->name('home');

Route::get('services', [ServicesController::class,'index'])->name('services');
Route::get('/blog', [BlogController::class,'index'])->name('blogs');
Route::post('/blog', [BlogController::class,'search'])->name('search');


Route::post('/', [EmailController::class,'sendWelcomeEmail'])->name('sendmail');



Route::get('/blog-details/{id}/{cat_id}', function () {
    return view('blog-details');
})->name('blog-details');

Route::get('/blog/search', [BlogController::class, 'search'])->name('blog.search');

Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/blog/tag/{slug}', [BlogController::class, 'indexByTag'])->name('blogs.tag');

// Define the route that handles filtering by category slug
Route::get('/blog/category/{slug}', [BlogController::class, 'indexByCategory'])->name('blogs.category');



Route::get('/portfolio', function () {
    return view('portfolio');
})->name('portfolio');

Route::get('/testimonials', function () {
    return view('testimonials');
})->name('testimonials');

/*Route::get('/blog-details/{id}/{cat_id}', 'App\Http\Controllers\BlogDetailsController@show')->name('blog-details');*/

Route::get('/offers', [App\Http\Controllers\OfferController::class, 'index'])->name('offers');
Route::post('/offers/book', [App\Http\Controllers\OfferController::class, 'book'])->name('offers.book');



Route::post('/track-visit', [VisitorController::class, 'store']);

Route::post('/auth/{provider}/start', [SocialAuthController::class, 'start']);
Route::get('/auth/{provider}', [SocialAuthController::class, 'redirect'])->name('social.redirect');
Route::get('/auth/{provider}/callback', [SocialAuthController::class, 'callback']);
Route::get('/logout', [SocialAuthController::class, 'logout'])->name('logout');
Route::get('/my-booking', [OfferController::class, 'showMyBooking'])->name('booking.show');
Route::patch('/booking/{id}', [OfferController::class, 'cancelBooking'])->name('booking.cancel');

// registration and login routes via email and password
Route::get('register', [SocialAuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [SocialAuthController::class, 'register']);

Route::get('login', [SocialAuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [SocialAuthController::class, 'login']);


