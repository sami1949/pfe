<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Main home route with name
Route::get('/', function () {
    return view('welcome');
})->name('home'); // Added route name here

// Auth routes
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin routes
Route::get('admin/dashboard', [HomeController::class, 'index'])
    ->middleware(['auth', 'admin'])
    ->name('admin.dashboard');

// Products routes
Route::prefix('dashboard')->middleware(['auth'])->group(function () {
    Route::get('/products', [ProductController::class, 'index'])
        ->name('products.index');
});

require __DIR__.'/auth.php';