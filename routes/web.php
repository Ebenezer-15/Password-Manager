<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PasswordController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [PasswordController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/passwords/create', [PasswordController::class, 'create'])->name('password.create');
    Route::post('/passwords/store', [PasswordController::class, 'store'])->name('soc.store');
    Route::delete('/passwords/{id}', [PasswordController::class, 'destroy'])->name('password.destroy');
    Route::put('/passwords/{id}', [PasswordController::class, 'update'])->name('password.update');
});

require __DIR__ . '/auth.php';
