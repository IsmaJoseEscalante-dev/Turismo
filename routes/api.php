<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Route;

Route::get('images/{id}',[ImageController::class, 'index']);
Route::post('storeTour/{id}',[ImageController::class,'storeTour'])->name('store.tour');
Route::post('storeStation/{id}',[ImageController::class,'storeStation'])->name('store.station');
Route::delete('deleteTour/{id}',[ImageController::class,'deleteTour'])->name('delete.tour');
Route::delete('deleteStation/{id}',[ImageController::class,'deleteStation'])->name('delete.station');

Route::resource('events',EventController::class);
