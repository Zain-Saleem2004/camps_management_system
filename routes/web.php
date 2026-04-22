<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CampController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\ContactController;


// Public صفحات
Route::view('/', 'public/home')->name('home');
Route::view('/contact', 'public/contact')->name('contact');
Route::view('/join', 'join')->name('join');
Route::view('/signin', 'public/signin')->name('signin');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Dashboard
Route::prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Camps
    Route::resource('camps', CampController::class)->names('camps');

    // Registration Requests
    Route::get('/requests', [RequestController::class, 'index'])->name('requests.index');
    Route::get('/requests/{id}', [RequestController::class, 'show'])->name('requests.show');
    Route::post('/requests/{id}/approve', [RequestController::class, 'approve'])->name('requests.approve');
    Route::post('/requests/{id}/reject', [RequestController::class, 'reject'])->name('requests.reject');

    // Messages
    Route::get('/messages', [DashboardController::class, 'messagesIndex'])->name('messages.index');
    Route::get('/messages/{id}', [DashboardController::class, 'showMessage'])->name('dashboard.messages.show');
    Route::delete('/messages/{id}', [DashboardController::class, 'deleteMessage'])->name('dashboard.messages.delete');
});


Route::view('/families', 'families')->name('families');
Route::view('/family-members', 'family-members')->name('family-members');
Route::view('/register-family', 'register-family')->name('register-family');