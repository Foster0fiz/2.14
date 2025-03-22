<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProfileController;

// Tizimga kirmaganlar faqat Login va Register sahifalariga kira oladi
Route::middleware('auth.redirect')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);

    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);
});

// Login qilmagan foydalanuvchi Edit Profile sahifasiga kira olmaydi
Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('home');
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit')->middleware('auth.profile');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});
