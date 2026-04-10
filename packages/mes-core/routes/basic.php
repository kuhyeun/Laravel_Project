<?php

use Illuminate\Support\Facades\Route;
use MesCore\Basic\Controllers\BasicController;
use MesCore\Auth\Middleware\AdminAuth;

// TODO: 기준정보관리 모듈 라우트 정의
Route::prefix('basic')->name('basic.')->group(function() {
    
    Route::middleware([AdminAuth::class])->group(function() {
        Route::get('/code', [BasicController::class, 'codeManage'])->name('code');
        Route::get('/menu', [BasicController::class, 'menuManage'])->name('menu');
        Route::get('/member', [BasicController::class, 'member'])->name('mem');
        Route::get('/memberAuth', [BasicController::class, 'memberAuth'])->name('auth');
        Route::get('/preferences', [BasicController::class, 'preferences'])->name('pref');
        Route::get('/systemConfig', [BasicController::class, 'systemConfig'])->name('conf');
    });
});