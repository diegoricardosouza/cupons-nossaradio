<?php

use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\ListMailController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/city/{slug}', [HomeController::class, 'city'])->name('home.city');
Route::post('/city-ajax', [HomeController::class, 'ajaxDownload'])->name('home.ajax.city');
Route::post('/storemail', [HomeController::class, 'ajaxEmail'])->name('home.ajax.email');

// Gera link simbolico
Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
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

    Route::delete('/coupons/{id}', [CouponController::class, 'destroy'])->name('coupons.destroy');
    Route::put('/coupons/{id}', [CouponController::class, 'update'])->name('coupons.update');
    Route::get('/coupons/{id}/edit', [CouponController::class, 'edit'])->name('coupons.edit');
    Route::get('/coupons', [CouponController::class, 'index'])->name('coupons.index');
    Route::get('/coupons/create', [CouponController::class, 'create'])->name('coupons.create');
    Route::post('/coupons', [CouponController::class, 'store'])->name('coupons.store');

    Route::delete('/list/{id}', [ListMailController::class, 'destroy'])->name('list.destroy');
    Route::put('/list/{id}', [ListMailController::class, 'update'])->name('list.update');
    Route::get('/list/{id}/edit', [ListMailController::class, 'edit'])->name('list.edit');
    Route::get('/list', [ListMailController::class, 'index'])->name('list.index');
    Route::get('/list/create', [ListMailController::class, 'create'])->name('list.create');
    Route::post('/list', [ListMailController::class, 'store'])->name('list.store');
    Route::get('/list/export', [ListMailController::class, 'export'])->name('list.export');
});

require __DIR__.'/auth.php';
