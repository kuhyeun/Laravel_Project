<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController; // 사용자 인증 컨트롤러

// LANDING PAGE
Route::get('/', function () {
    return redirect( '/users' );
});

Route::prefix('users')->name('user.')->group(function () {
    Route::redirect('/', '/users/login');

    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');

    Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [UserController::class, 'processLogin'])->name('login.process');

    Route::get('/logout', [UserController::class, 'logout'])->name('logout');

    Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [UserController::class, 'processRegistration'])->name('register.process');
});