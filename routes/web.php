<?php

use App\Http\Controllers\Admin\ConfigsController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Guest\AboutController;
use App\Http\Controllers\Guest\BlogController;
use App\Http\Controllers\Guest\ContactController;
use App\Http\Controllers\Guest\IndexController;
use App\Http\Controllers\Guest\NewsletterController;
use App\Http\Controllers\Guest\PharmacyController;
use App\Http\Controllers\Guest\UploadController;
use Illuminate\Support\Facades\Route;

Route::namespace('Guest')->group(function() {
    Route::get('/', [IndexController::class,'index'])->name('guest.index');
    Route::get('sobre-nos', [AboutController::class,'index'])->name('guest.about');
    Route::get('contato', [ContactController::class,'index'])->name('guest.contact');
    Route::get('blog', [BlogController::class, 'index'])->name('guest.blog');
    Route::get('blog/{category}', [BlogController::class, 'category'])->name('guest.blog.category');
    Route::get('blog/{category}/{slug}', [BlogController::class, 'inner'])->name('guest.blog.inner');


    Route::post('blog/pesquisa-blog', [BlogController::class, 'search'])->name('blog.search');
    Route::post('enviar-newsletter', [NewsletterController::class, 'newsletter'])->name('send.newsletter');
    Route::post('enviar-contato', [ContactController::class, 'send'])->name('send.contact');
    Route::post('enviar-receita', [UploadController::class, 'send'])->name('send.receipt');
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
