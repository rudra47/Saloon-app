<?php
use App\Http\Controllers\Admin\Dashboard\DashboardController;

//CUSTOMER CONTROLLERS
use App\Http\Controllers\Customer\MapController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Customer\SaloonController;
use App\Http\Controllers\Customer\PagesController;
//APP
Use App\Http\Controllers\AppAuthController;
use Illuminate\Support\Facades\Route;

// CUSTOMER PANEl ROUTES
Route::get('/', [PagesController::class, 'index'])->name('home');

Route::get('/map', [MapController::class, 'index'])->name('map');

Route::post('/book-saloon', [MapController::class, 'store'])->name('saloon.book')->middleware('auth');
Route::get('/saloon-apply', [SaloonController::class, 'index'])->name('saloon.apply');
Route::post('/saloon-apply/submit', [SaloonController::class, 'store'])->name('saloon.apply.submit');

Route::get('/profile', [CustomerController::class, 'index'])->name('profile')->middleware('auth');
Route::post('/profile/edit/{id}', [CustomerController::class, 'update'])->name('profile.update')->middleware('auth');
Route::post('/profile/change-password/{id}', [CustomerController::class, 'update_password'])->name('profile.changePassword')->middleware('auth');


//ADMIN PANEL
Route::get('/app', function () {
    return redirect()->route('app.login');
});
Route::prefix('app')->as('app.')->group(function () {
    Route::get('/login', [AppAuthController::class, 'login'])->name('login');
    Route::post('/loginAction', [AppAuthController::class, 'loginAction'])->name('loginAction');
    Route::post('/logout', [AppAuthController::class, 'logout'])->name('logout');
    // DASHBOARD
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware('admin')->group(function () {
    Route::prefix('admin')->as('admin.')->group(function () {
        Route::get('/saloons', [SaloonController::class, 'saloon'])->name('saloons');
        Route::get('/customers', [CustomerController::class, 'customer'])->name('customers');
    });
});
