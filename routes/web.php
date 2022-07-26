<?php

use App\Http\Controllers\Admin\Dashboard\DashboardController;

//CUSTOMER CONTROLLERS
use App\Http\Controllers\Customer\MapController;
use App\Http\Controllers\Customer\CustomerController;

use Illuminate\Support\Facades\Route;

// CUSTOMER PANEl ROUTES
Route::get('/', [MapController::class, 'index'])->name('home');
Route::post('/book-saloon', [MapController::class, 'store'])->name('saloon.book')->middleware('auth');
Route::post('/saloon-apply', [MapController::class, 'store'])->name('saloon.apply')->middleware('auth');

Route::get('/profile', [CustomerController::class, 'index'])->name('profile')->middleware('auth');
Route::post('/profile/edit/{id}', [CustomerController::class, 'update'])->name('profile.update')->middleware('auth');
Route::post('/profile/change-password/{id}', [CustomerController::class, 'update_password'])->name('profile.changePassword')->middleware('auth');

// ADMIN DASHBOARD ROUTES
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

