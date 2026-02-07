<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'landing')->name('landing');

// Auth
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// App pages
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [ContactController::class, 'dashboard'])->name('dashboard');
    Route::post('/contacts/import', [ContactController::class, 'import'])->name('contacts.import');
    Route::resource('contacts', ContactController::class);
});
