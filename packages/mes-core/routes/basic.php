<?php

use Illuminate\Support\Facades\Route;
use MesCore\Basic\Controllers\BasicController;
use MesCore\Basic\Controllers\SampleController;
use MesCore\Auth\Middleware\AdminAuth;

// TODO: 기준정보관리 모듈 라우트 정의

Route::middleware([AdminAuth::class])->group(function() {
    Route::prefix('basic')->name('basic.')->group(function() {
        Route::get('/code', [BasicController::class, 'codeManage'])->name('code');
        Route::get('/menu', [BasicController::class, 'menuManage'])->name('menu');
        Route::get('/member', [BasicController::class, 'member'])->name('mem');
        Route::get('/memberAuth', [BasicController::class, 'memberAuth'])->name('auth');
        Route::get('/preferences', [BasicController::class, 'preferences'])->name('pref');
        Route::get('/systemConfig', [BasicController::class, 'systemConfig'])->name('conf');
    });
    
    Route::prefix('chart')->name('chart.')->group(function() {
        Route::get('/bar', [SampleController::class, 'barChart'])->name('bar');
        Route::get('/line', [SampleController::class, 'lineChart'])->name('line');
        Route::get('/circle', [SampleController::class, 'circleChart'])->name('circle');
        Route::get('/combo', [SampleController::class, 'comboChart'])->name('combo');
    });
    
    Route::prefix('dev')->name('dev.')->group(function() {
        Route::get( '/api', [SampleController::class, 'api'])->name('api');
        Route::get( '/apiGet', [SampleController::class, 'apiGet'])->name('apiGet');
        Route::post( '/apiPost', [SampleController::class, 'apiPost'])->name('apiPost');
    });
});