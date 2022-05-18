<?php

use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});





Route::middleware('auth')->group(function() {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');

    Route::delete('/cities/{id}', [CityController::class, 'destroy'])->name('cities.destroy');
    Route::put('/cities/{id}', [CityController::class, 'update'])->name('cities.update');
    Route::get('/cities/{id}/edit', [CityController::class, 'edit'])->name('cities.edit');
    Route::get('/cities', [CityController::class, 'index'])->name('cities.index');
    Route::get('/cities/create', [CityController::class, 'create'])->name('cities.create');
    Route::post('/cities', [CityController::class, 'store'])->name('cities.store');

    Route::get('/coupons', function () {
        return view('coupons');
    })->name('coupons');
});



require __DIR__.'/auth.php';
