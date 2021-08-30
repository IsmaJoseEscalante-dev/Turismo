<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('comments/{slug}', [CommentController::class,'comments'])->name('comments');
Route::get('comment-count', [CommentController::class, 'commentCount'])->name('comments.count');
Route::get('tour/{id}',[WelcomeController::class,'tour'])->name('tour.show');

Route::post('cart', [CartController::class,'store']);

//Routes admin
    Route::get('images/{id}',[ImageController::class, 'index']);
    Route::post('storeTour/{id}',[ImageController::class,'storeTour'])->name('store.tour');
    Route::post('storeStation/{id}',[ImageController::class,'storeStation'])->name('store.station');
    Route::delete('deleteTour/{id}',[ImageController::class,'deleteTour'])->name('delete.tour');
    Route::delete('deleteStation/{id}',[ImageController::class,'deleteStation'])->name('delete.station');
    Route::resource('events',EventController::class);
