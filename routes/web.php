<?php

use App\Http\Controllers\Admin\ConfigsController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Guest\IndexController;
use App\Http\Controllers\Guest\PharmacyController;
use App\Http\Controllers\Guest\UploadController;
use Illuminate\Support\Facades\Route;

Route::namespace('Guest')->group(function() {
    Route::get('/', [IndexController::class,'index']);

    Route::post('enviar-receita', [UploadController::class, 'send']);
    Route::post('criar-farmacia', [PharmacyController::class, 'create']);
});


Route::middleware(['auth'])->group(function () {
    Route::namespace('Admin')->group(function () {
        Route::prefix('dashboard')->group(function(){
            Route::get('/', [HomeController::class, 'index'])->name('dashboard');

            Route::prefix('configs')->group(function() {
                Route::get('/', [ConfigsController::class, 'index'])->name('configs');
            });
        });
    });
});


require __DIR__.'/auth.php';
