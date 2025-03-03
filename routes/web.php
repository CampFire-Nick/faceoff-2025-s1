<?php

use App\Http\Controllers\PackageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(UserController::class)->middleware(['auth', 'verified'])->group(function () {
    Route::get('/users', 'index')->name('users.index');
    Route::get('/users/create', 'create')->name('users.create');
    Route::post('/users', 'store')->name('users.store');
    Route::get('/users/{user}', 'show')->name('users.show');
    Route::get('/users/{user}/edit', 'edit')->name('users.edit');
    Route::match(['put', 'patch'], '/users/{user}', 'update')->name('users.update');
    Route::delete('/users/{user}', 'destroy')->name('users.destroy');
});

Route::controller(PackageController::class)->middleware(['auth', 'verified'])->group(function () {
    Route::get('/packages', 'index')->name('packages.index');
    Route::get('/packages/create', 'create')->name('packages.create');
    Route::post('/packages', 'store')->name('packages.store');
    Route::get('/packages/{package}', 'show')->name('packages.show');
    Route::get('/packages/{package}/edit', 'edit')->name('packages.edit');
    Route::match(['put', 'patch'], '/packages/{package}', 'update')->name('packages.update');
    Route::delete('/packages/{package}', 'destroy')->name('packages.destroy');
});

require __DIR__ . '/auth.php';
