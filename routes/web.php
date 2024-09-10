<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerFieldController;
use App\Http\Controllers\OwnerFieldController;
use App\Http\Controllers\OwnerPaymentController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/password/reset', [AuthController::class, 'showResetForm'])->name('password.request');
Route::post('/password/email', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
Route::post('/password/reset', [AuthController::class, 'reset'])->name('password.update');

Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/fields', [CustomerFieldController::class, 'index'])->name('fields.index');
    Route::get('/fields/{field}', [CustomerFieldController::class, 'show'])->name('fields.show');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::patch('/cart/{cart}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{cart}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::get('/checkout', [PaymentController::class, 'checkoutIndex'])->name('checkout.index');
    Route::post('/payment', [PaymentController::class, 'store'])->name('payment.store');
    Route::get('/transactions', [PaymentController::class, 'index'])->name('transactions.index');
});


Route::middleware(['auth', 'role:owner'])->group(function () {
    Route::get('/owner/fields', [OwnerFieldController::class, 'index'])->name('owner.fields.index');
    Route::get('/owner/fields/create', [OwnerFieldController::class, 'create'])->name('owner.fields.create');
    Route::post('/owner/fields', [OwnerFieldController::class, 'store'])->name('owner.fields.store');
    Route::get('/owner/fields/{field}/edit', [OwnerFieldController::class, 'edit'])->name('owner.fields.edit');
    Route::put('/owner/fields/{field}', [OwnerFieldController::class, 'update'])->name('owner.fields.update');
    Route::delete('/owner/fields/{field}', [OwnerFieldController::class, 'destroy'])->name('owner.fields.destroy');

    Route::get('/owner/bookings', [BookingController::class, 'index'])->name('owner.bookings.index');
    Route::get('/owner/bookings/{booking}', [BookingController::class, 'show'])->name('owner.bookings.show');

    Route::get('/owner/reports', [ReportController::class, 'index'])->name('owner.reports.index');

    // Existing route for index
    Route::get('/owner/transactions', [OwnerPaymentController::class, 'index'])->name('owner.transactions.index');

// Route for updating payment status
    Route::put('/owner/transactions/{payment}', [OwnerPaymentController::class, 'update'])->name('owner.transactions.update');
});
