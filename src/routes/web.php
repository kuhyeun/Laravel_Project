<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\MenuController;
use App\Http\Middleware\GuestAuth;
use App\Http\Middleware\UserAuth;
use App\Http\Middleware\AdminAuth;

// LANDING PAGE
Route::get('/', function () {
    return redirect( '/user' );
});

Route::prefix('menu')->name('menu.')->group(function() {

    Route::middleware([AdminAuth::class])->group(function() {
        Route::post('/insertAdminMenu', [MenuController::class, 'insertAdminMenu'])->name('ins.admin');
        Route::post('/updateAdminMenu', [MenuController::class, 'updateAdminMenu'])->name('upt.admin');
        Route::post('/deleteAdminMenu', [MenuController::class, 'deleteAdminMenu'])->name('del.admin');
    });

    Route::middleware([UserAuth::class])->group(function() {
        Route::post('/insertUserMenu', [MenuController::class, 'insertUserMenu'])->name('ins.user');
        Route::post('/updateUserMenu', [MenuController::class, 'updateUserMenu'])->name('upt.user');
        Route::post('/deleteUserMenu', [MenuController::class, 'deleteUserMenu'])->name('del.user');
    });
});

Route::prefix('user')->name('user.')->group(function() {
    Route::redirect('/', '/user/login');

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
        Route::get('/dashboard2', [UserController::class, 'dashboard2'])->name('dashboard2');
        Route::get('/logout', [UserController::class, 'logout'])->name('logout');
    });

    // 관리자 권한 이상 접근
    Route::middleware([AdminAuth::class])->group(function() {
        
    });
});
