<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CampController;

// Public صفحات
Route::view('/', 'public/home')->name('home');
Route::view('/contact', 'public/contact')->name('contact');
Route::view('/join', 'join')->name('join');
Route::view('/signin', 'public/signin')->name('signin');

// Dashboard
Route::prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('camps', CampController::class);
});


Route::view('/families', 'families')->name('families');
Route::view('/family-members', 'family-members')->name('family-members');
Route::view('/register-family', 'register-family')->name('register-family');