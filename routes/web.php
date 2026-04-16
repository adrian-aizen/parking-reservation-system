<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ParkinglotController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/home', [ParkinglotController::class, 'index'])->name('home');
    Route::post('/parking-lots', [ParkinglotController::class, 'store'])->name('parkinglots.store');
    Route::get('/parking-lots/{parkinglot}', [ParkinglotController::class, 'show'])->name('parkinglots.show');

    Route::get('/receipts', [ReservationController::class, 'receipts'])->name('receipts.index');
    Route::resource('reservations', ReservationController::class);
    Route::get('/reservations/{reservation}/success', [ReservationController::class, 'success'])->name('reservations.success');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin Routes
    Route::get('/admin/reservations', [ReservationController::class, 'adminIndex'])->name('admin.reservations.index');
    Route::get('/admin/reservations/{reservation}', [ReservationController::class, 'adminShow'])->name('admin.reservations.show');
    Route::get('/admin/reservations/{reservation}/edit', [ReservationController::class, 'adminEdit'])->name('admin.reservations.edit');
    Route::patch('/admin/reservations/{reservation}', [ReservationController::class, 'adminUpdate'])->name('admin.reservations.update');
    Route::delete('/admin/reservations/{reservation}', [ReservationController::class, 'adminDestroy'])->name('admin.reservations.destroy');

    Route::get('/admin/parking-lots', [ParkinglotController::class, 'adminIndex'])->name('admin.parkinglots.index');
    Route::post('/admin/parking-lots', [ParkinglotController::class, 'adminStore'])->name('admin.parkinglots.store');
    Route::get('/admin/parking-lots/{parkinglot}/edit', [ParkinglotController::class, 'adminEdit'])->name('admin.parkinglots.edit');
    Route::patch('/admin/parking-lots/{parkinglot}', [ParkinglotController::class, 'adminUpdate'])->name('admin.parkinglots.update');
    Route::delete('/admin/parking-lots/{parkinglot}', [ParkinglotController::class, 'adminDestroy'])->name('admin.parkinglots.destroy');
});


require __DIR__.'/auth.php';
