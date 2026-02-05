<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\LoginController; // 새로 생성될 LoginController

// LANDING PAGE
Route::get('/', function () {
    // return redirect('/users');
    return view('welcome');
});

// --- User-related routes group with redirect and catch-all for undefined paths ---
Route::prefix('users')->name('user.')->group(function () {

    // 1. 구체적인 로그인 라우트를 먼저 정의합니다.
    // LoginController가 아직 없다면, `php artisan make:controller User/LoginController`로 생성해야 합니다.
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'processLogin'])->name('login.process');

    // (예시: 로그인 후 접근 가능한 대시보드 등의 정상적인 라우트들)
    // Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard')->middleware('auth.user');

    // 2. 그룹의 메인 경로인 '/users'로 접속하면 '/users/login'으로 리다이렉트합니다.
    Route::redirect('/', '/users/login');

    // 3. 위에서 정의되지 않은 '/users/' 하위의 모든 경로를 '/users/login'으로 리다이렉트하는 캐치올 라우트 (맨 마지막에 둡니다!)
    // 예를 들어, /users/abc, /users/profile/edit (정의되지 않았다면) 등이 여기에 걸립니다.
    Route::get('/{any}', function () {
        abort(404);
    })->where('any', '.*');
});