<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\StationController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\UserController;

Auth::routes();

Route::get('/', [WelcomeController::class, 'welcome'])->name('welcome');
Route::get('paradas/{slug}', [WelcomeController::class, 'paradas'])->name('paradas');
Route::get('promociones/{slug}', [WelcomeController::class, 'promotions'])->name('promotions');
Route::get('events/{slug}', [WelcomeController::class, 'events'])->name('events');

Route::post('comments', [CommentController::class, 'store'])->name('comments.store');


//Routes role user
Route::middleware(['auth', 'role:user'])->group(function (){
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('checkout',[CartController::class,'index'])->name('checkout');
    Route::delete('carts/{id}',[CartController::class,'destroy'])->name('carts.destroy');

    //Actualizar usuario
    Route::put('users', [UserController::class, 'updateUser'])->name('users.update');
    Route::put('password', [UserController::class, 'updatePassword'])->name('users.password');

    Route::get('booking', [WelcomeController::class, 'booking'])->name('booking');
    Route::get('booking/{id}', [BookingController::class,'show'])->name('booking.show');
    Route::get('bookings/{id}', [BookingController::class,'bookingCart'])->name('booking');

    //routes pay with mercado pago
    Route::post('/payments/pay', [PaymentController::class,'pay'])->name('pay');
    Route::get('/payments/approval', [PaymentController::class,'approval'])->name('approval');
    Route::get('/payments/cancelled',  [PaymentController::class,'cancelled'])->name('cancelled');
});


//Route role admin
Route::middleware(['auth','role:admin'])->group(function () {
    Route::get('dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::resource('categories', CategoryController::class);

    Route::resource('tours', TourController::class);
    Route::resource('stations', StationController::class);
    Route::resource('promotions', PromotionController::class);
    Route::resource('bookings', BookingController::class);
    Route::resource('carts', CartController::class);
    Route::get('show',[CartController::class, 'show'])->name('carts.show');
    Route::get('events', [EventController::class, 'events'])->name('events.events');

    //Comments
    Route::get('comments', [CommentController::class, 'index'])->name('comments.index');
    Route::get('unread_comments', [CommentController::class, 'unread'])->name('comments.unread');
    Route::put('comments/{id}', [CommentController::class, 'publish'])->name('comments.publish');
    Route::put('comment/{id}', [CommentController::class, 'ignore'])->name('comments.ignore');
    Route::delete('comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');
    Route::get('comments/{id}', [CommentController::class, 'show'])->name('comments.show');
});
