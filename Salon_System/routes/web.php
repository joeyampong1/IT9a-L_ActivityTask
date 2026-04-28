<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

// Public route (walang authentication)
Route::get('/', function () {
    return view('welcome');
});

// Isang group para sa lahat ng authenticated routes
Route::middleware(['auth'])->group(function () {
    // Dashboard (kung gusto mong nasa loob din ito ng auth)
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Service Management (CRUD)
    Route::resource('services', ServiceController::class);

    // Booking Management (CRUD)
    Route::resource('bookings', BookingController::class);

    // Payment Management
    Route::get('payments/history', [PaymentController::class, 'history'])->name('payments.history');
    Route::get('bookings/{booking}/payment', [PaymentController::class, 'create'])->name('payments.create');
    Route::post('bookings/{booking}/payment', [PaymentController::class, 'store'])->name('payments.store');
});

// Auth routes (login, register, etc.) - provided by Breeze
require __DIR__.'/auth.php';