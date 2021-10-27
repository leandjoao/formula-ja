<?php

use App\Http\Controllers\Admin\BudgetsController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PartnersController;
use App\Http\Controllers\Admin\PostsController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Guest\AboutController;
use App\Http\Controllers\Guest\BlogController;
use App\Http\Controllers\Guest\ContactController;
use App\Http\Controllers\Guest\IndexController;
use App\Http\Controllers\Guest\NewsletterController;
use App\Http\Controllers\Guest\PetController;
use App\Http\Controllers\Guest\PharmacyController;
use App\Http\Controllers\Guest\TermsPolitcsController;
use App\Http\Controllers\Guest\UploadController;
use Illuminate\Support\Facades\Route;

Route::namespace('Guest')->group(function() {
    Route::get('/', [IndexController::class,'index'])->name('guest.index');
    Route::get('sobre-nos', [AboutController::class,'index'])->name('guest.about');
    Route::get('contato', [ContactController::class,'index'])->name('guest.contact');
    Route::get('pet', [PetController::class,'index'])->name('guest.pet');
    Route::get('blog', [BlogController::class, 'index'])->name('guest.blog');
    Route::get('blog/{category}', [BlogController::class, 'category'])->name('guest.blog.category');
    Route::get('blog/{category}/{slug}', [BlogController::class, 'inner'])->name('guest.blog.inner');

    Route::get('enviar-receita', [UploadController::class, 'index'])->name('guest.receita');
    Route::get('enviar-receita-pet', [UploadController::class, 'pet'])->name('guest.receita.pet');
    Route::get('termos-de-uso', [TermsPolitcsController::class, 'terms'])->name('guest.termos');
    Route::get('politica-de-privacidade', [TermsPolitcsController::class, 'politics'])->name('guest.privacidade');


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

            Route::prefix('profile')->group(function() {
                Route::get('/', [ProfileController::class, 'index'])->name('profile');

                Route::post('update-account', [ProfileController::class, 'update'])->name('profile.update');
                Route::post('change-password', [ProfileController::class, 'changePassword'])->name('profile.password');
                Route::post('change-address', [ProfileController::class, 'changeAddress'])->name('profile.address');
                Route::post('change-picture', [ProfileController::class, 'changePicture'])->name('profile.picture');
                Route::post('delete-account', [ProfileController::class, 'removeAccount'])->name('profile.remove');
            });

            Route::prefix('users')->group(function() {
                Route::get('/', [UsersController::class, 'index'])->name('users');

                Route::get('getUsers', [UsersController::class, 'getUsers'])->name('users.getUsers');
            });

            Route::prefix('partners')->group(function() {
                Route::get('/', [PartnersController::class, 'index'])->name('partners');
            });

            Route::prefix('contacts')->group(function() {
                Route::get('/', [AdminContactController::class, 'index'])->name('contact');
            });

            Route::prefix('budgets')->group(function() {
                Route::get('/', [BudgetsController::class, 'index'])->name('budgets');
                Route::get('inner', [BudgetsController::class, 'inner'])->name('budgets.inner');
            });

            Route::prefix('posts')->group(function() {
                Route::get('/', [PostsController::class, 'index'])->name('blog');
                Route::get('category', [PostsController::class, 'category'])->name('blog.category');
            });
        });
    });
});


require __DIR__.'/auth.php';
