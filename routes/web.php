<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TourController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\StationController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\CategoryController;

Auth::routes(['register' => true]);

Route::get('/', [WelcomeController::class, 'welcome'])->name('welcome');
Route::get('paradas/{slug}', [WelcomeController::class, 'paradas'])->name('paradas');
Route::get('booking', [WelcomeController::class,'booking'])->name('booking');
/* Route::middleware(['auth'])->group(function () { */
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');
Route::get('pagar', [App\Http\Controllers\HomeController::class, 'pagar'])->name('pagar');
Route::resource('tours', TourController::class);
Route::resource('categories', CategoryController::class);
Route::get('stations/{id}', [StationController::class, 'index'])->name('station.index');
Route::get('stations/create/{id}', [StationController::class, 'create'])->name('station.create');
Route::resource('station', StationController::class)->except(['index','create']);
Route::get('events', [EventController::class, 'events'])->name('events.events');
/* }); */
