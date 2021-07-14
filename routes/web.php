<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TourController;
use App\Http\Controllers\StationController;
use App\Http\Controllers\WelcomeController;

Auth::routes(['register' => false]);

Route::get('/', [WelcomeController::class, 'welcome'])->name('welcome');
Route::get('paradas/{slug}', [WelcomeController::class, 'paradas'])->name('paradas');

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('tours', TourController::class);

    Route::get('stations/{id}', [StationController::class, 'index'])->name('station.index');
    Route::get('stations/create/{id}', [StationController::class, 'create'])->name('station.create');
    Route::resource('station', StationController::class)->except(['index','create']);

});
