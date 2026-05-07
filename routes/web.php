<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CampController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\RepresentativeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DataEntryController;
use App\Http\Controllers\CommunicationController;
use App\Http\Controllers\SupporterController;
use App\Http\Controllers\JoinRequestController;


// Public صفحات
Route::view('/', 'public/home')->name('home');
Route::view('/contact', 'public/contact')->name('contact');
Route::view('/join', 'join')->name('join');
Route::view('/signin', 'public/signin')->name('signin');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/join', [JoinRequestController::class, 'create'])->name('join');
Route::post('/join', [JoinRequestController::class, 'store'])->name('join.store');

// Dashboard
Route::prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Camps
    Route::resource('camps', CampController::class)->names('camps');
    Route::get('/camps/{camp}/representative', [RepresentativeController::class, 'showByCamp'])->name('representatives.showByCamp');
    Route::get('/camps/{camp}/representative/replace', [RepresentativeController::class, 'replaceForm'])->name('representatives.replace.form');
    Route::put('/camps/{camp}/representative/replace', [RepresentativeController::class, 'replace'])->name('representatives.replace');
    Route::put('/representatives/{representative}', [RepresentativeController::class, 'update'])->name('representatives.update');

    // Registration Requests
    Route::get('/requests', [RequestController::class, 'index'])->name('requests.index');
    Route::get('/requests/{id}', [RequestController::class, 'show'])->name('requests.show');
    Route::post('/requests/{id}/approve', [RequestController::class, 'approve'])->name('requests.approve');
    Route::post('/requests/{id}/reject', [RequestController::class, 'reject'])->name('requests.reject');

    // Supporters
    Route::get('/supporters', [SupporterController::class, 'index'])->name('supporters.index');
    Route::get('/supporters/create', [SupporterController::class, 'create'])->name('supporters.create');
    Route::post('/supporters', [SupporterController::class, 'store'])->name('supporters.store');
    Route::get('/supporters/{supporter}/edit', [SupporterController::class, 'edit'])->name('supporters.edit');
    Route::put('/supporters/{supporter}', [SupporterController::class, 'update'])->name('supporters.update');
    Route::get('/supporters/{supporter}', [SupporterController::class, 'show'])->name('supporters.show');
    Route::delete('/supporters/{supporter}', [SupporterController::class, 'destroy'])->name('supporters.destroy');

    // Users
    Route::get('/users', [DashboardController::class, 'usersIndex'])->name('users.index');
    Route::get('/users/{user}/password', [UserController::class, 'passwordForm'])->name('users.password.form');
    Route::patch('/users/{user}/password', [UserController::class, 'updatePassword'])->name('users.password.update');
    Route::patch('/users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle-status');
    Route::get('/data-entries/create', [DataEntryController::class, 'create'])->name('data-entries.create');
    Route::post('/data-entries', [DataEntryController::class, 'store'])->name('data-entries.store');

    // Communication
    Route::get('/communications', [CommunicationController::class, 'edit'])->name('communications.edit');
    Route::put('/communications', [CommunicationController::class, 'update'])->name('communications.update');

    // Messages
    Route::get('/messages', [DashboardController::class, 'messagesIndex'])->name('messages.index');
    Route::get('/messages/{id}', [DashboardController::class, 'showMessage'])->name('dashboard.messages.show');
    Route::delete('/messages/{id}', [DashboardController::class, 'deleteMessage'])->name('dashboard.messages.delete');
});


Route::view('/families', 'families')->name('families');
Route::view('/family-members', 'family-members')->name('family-members');
Route::view('/register-family', 'register-family')->name('register-family');
