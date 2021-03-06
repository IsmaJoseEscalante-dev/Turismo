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
use Illuminate\Support\Facades\Artisan;

Auth::routes(['verify' => true]);

Route::get('/', [WelcomeController::class, 'welcome'])->name('welcome');

Route::get('/linkstorage', function(){
    Artisan::call('storage:link');
    return "successfully!";

});
Route::get('/linkstorage', function(){
    Artisan::call('storage:link');
    return "successfully!";
});

Route::get('paradas/{slug}', [WelcomeController::class, 'paradas'])->name('paradas');
Route::get('promociones/{slug}', [WelcomeController::class, 'promotions'])->name('promotions');
Route::get('events/{slug}', [WelcomeController::class, 'events'])->name('events');

Route::post('comments', [CommentController::class, 'store'])->name('comments.store');


//Routes role user
Route::middleware(['auth','verified', 'role:user'])->group(function (){
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('checkout',[CartController::class,'index'])->name('checkout');
    Route::delete('carts/{id}',[CartController::class,'destroy'])->name('carts.destroy');

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
    /* Route::get('users', [UserController::class, 'show'])->name('users.show'); */
    Route::resource('tours', TourController::class);
    Route::resource('stations', StationController::class);
    Route::resource('promotions', PromotionController::class);
    Route::resource('bookings', BookingController::class);
    Route::resource('carts', CartController::class);
    Route::get('show',[CartController::class, 'show'])->name('carts.show');
    Route::get('events', [EventController::class, 'events'])->name('events.events');
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('usersCart/{user}',[UserController::class, 'showCart'])->name('users.showCart');
    Route::get('usersBooking/{user}',[UserController::class, 'showBooking'])->name('usersAdmin.booking');

    //Comments
    Route::get('comments', [CommentController::class, 'index'])->name('comments.index');
    Route::get('unread_comments', [CommentController::class, 'unread'])->name('comments.unread');
    Route::put('comments/{id}', [CommentController::class, 'publish'])->name('comments.publish');
    Route::put('comment/{id}', [CommentController::class, 'ignore'])->name('comments.ignore');
    Route::delete('comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');
    Route::get('comments/{id}', [CommentController::class, 'show'])->name('comments.show');
    Route::get('admin/edit',[UserController::class,'editDataAdmin'])->name('admin.edit');
});

 //Actualizar usuario
 Route::put('users', [UserController::class, 'updateUser'])
        ->name('users.update')
        ->middleware('auth');
 Route::put('password', [UserController::class, 'updatePassword'])
        ->name('users.password')
        ->middleware('auth');
