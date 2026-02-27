<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController; // 사용자 인증 컨트롤러
use App\Http\Middleware\GuestAuth;
use App\Http\Middleware\UserAuth;
use App\Http\Middleware\AdminAuth;

// LANDING PAGE
Route::get('/', function () {
    return redirect( '/users' );
});

Route::prefix('users')->name('user.')->group(function () {
    Route::redirect('/', '/users/login');

    // 게스트 사용자만 접근
    Route::middleware([GuestAuth::class])->group(function() {
        Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [UserController::class, 'processLogin'])->name('login.process');

        Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('register');
        Route::post('/register', [UserController::class, 'processRegistration'])->name('register.process');
    });

    // 로그인된 사용자 접근
    Route::middleware([UserAuth::class])->group(function() {
        Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
        Route::get('/logout', [UserController::class, 'logout'])->name('logout');
    });

    // 관리자 권한 이상 접근
    Route::middleware([AdminAuth::class])->group(function() {
        
    });
});