<?php
use App\Http\Controllers\Admin\Dashboard\DashboardController;
//ADMIN CONTROLLERS
use App\Http\Controllers\Admin\AdminSaloonController;
use App\Http\Controllers\Admin\AdminCustomerController;
//CUSTOMER CONTROLLERS
use App\Http\Controllers\Customer\MapController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Customer\SaloonController;
use App\Http\Controllers\Customer\PagesController;
use App\Http\Controllers\Saloon\ServiceController;
use App\Http\Controllers\Saloon\BookingController;
//APP
Use App\Http\Controllers\AppAuthController;
use Illuminate\Support\Facades\Route;

// CUSTOMER PANEl ROUTES
Route::get('/', [MapController::class, 'index'])->name('home');
//Route::get('/', [PagesController::class, 'index'])->name('home');
Route::get('get-saloons/{latitude}/{longitude}', [PagesController::class, 'getSaloons'])->name('getSaloons');

Route::get('/map', [MapController::class, 'index'])->name('map');

Route::get('/saloon/{id}', [SaloonController::class, 'show'])->name('saloon.view');

Route::post('/book-saloon', [SaloonController::class, 'book'])->name('saloon.book')->middleware('auth');
Route::get('/saloon-apply', [SaloonController::class, 'index'])->name('saloon.apply');
Route::post('/saloon-apply/submit', [SaloonController::class, 'store'])->name('saloon.apply.submit');

Route::get('/profile', [CustomerController::class, 'index'])->name('profile')->middleware('auth');
Route::post('/profile/edit', [CustomerController::class, 'update'])->name('profile.update')->middleware('auth');
Route::post('/profile/change-password/{id}', [CustomerController::class, 'update_password'])->name('profile.changePassword')->middleware('auth');
Route::get('/bookings', [CustomerController::class, 'bookings'])->name('bookings')->middleware('auth');
Route::get('/bookings/all', [CustomerController::class, 'all_bookings'])->name('bookings.all')->middleware('auth');
Route::get('/bookings/cancel/{id}', [CustomerController::class, 'destroy'])->name('bookings.cancel')->middleware('auth');
Route::get('/bookings/confirm/{id}', [CustomerController::class, 'confirmation'])->name('bookings.confirmation')->middleware('auth');
Route::post('/bookings/confirmationStore/{id}', [CustomerController::class, 'confirmationStore'])->name('bookings.confirmationStore')->middleware('auth');


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

    Route::middleware('admin')->group(function () {
        Route::prefix('admin')->as('admin.')->group(function () {
            Route::get('/saloons', [AdminSaloonController::class, 'saloons'])->name('saloons');
            Route::get('/saloons/activation/{saloon_id}', [AdminSaloonController::class, 'activation'])->name('saloons.activation');
            Route::post('/saloons/activationStore/{saloon_id}', [AdminSaloonController::class, 'activationStore'])->name('saloons.activationStore');
            Route::get('/customers', [AdminCustomerController::class, 'customers'])->name('customers');
        });
    });
    Route::middleware('saloon')->group(function () {
        Route::prefix('saloon')->as('saloon.')->group(function () {
            Route::resource('/service', ServiceController::class);
            Route::prefix('bookings')->as('bookings.')->group(function (){
                Route::get('/', [BookingController::class, 'index'])->name('index');
                Route::get('/confirmation/{booking_id}', [BookingController::class, 'confirmation'])->name('confirmation');
                Route::post('/confirmationStore/{booking_id}', [BookingController::class, 'confirmationStore'])->name('confirmationStore');
            });
        });
    });
});

