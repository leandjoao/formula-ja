<?php

use App\Http\Controllers\Admin\BudgetsController;
use App\Http\Controllers\Admin\ConfigController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PartnersController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\InfoGeralController;
use App\Http\Controllers\Admin\Paginas\InfoHomeController;
use App\Http\Controllers\Admin\Paginas\InfoPetController;
use App\Http\Controllers\Admin\Paginas\InfoAboutController;
use App\Http\Controllers\Admin\Paginas\InfoContatoController;
use App\Http\Controllers\Admin\Paginas\InfoBlogController;
use App\Http\Controllers\Admin\Paginas\InfoFaqController;
use App\Http\Controllers\Admin\Paginas\InfoParceiroController;
use App\Http\Controllers\Admin\PostsController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\TestemonialController;
use App\Http\Controllers\Admin\TextController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Guest\AboutController;
use App\Http\Controllers\Guest\BlogController;
use App\Http\Controllers\Guest\ContactController;
use App\Http\Controllers\Guest\HelpController;
use App\Http\Controllers\Guest\IndexController;
use App\Http\Controllers\Guest\NewsletterController;
use App\Http\Controllers\Guest\PasswordController;
use App\Http\Controllers\Guest\PetController;
use App\Http\Controllers\Guest\PharmacyController;
use App\Http\Controllers\Guest\TermsPolitcsController;
use App\Http\Controllers\Guest\SejaUmParceiroController;
use App\Http\Controllers\Guest\UploadController;
use Faker\Generator;
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
    Route::get('seja-um-parceiro', [SejaUmParceiroController::class, 'parceiro'])->name('guest.parceiro');
    Route::post('blog/pesquisa-blog', [BlogController::class, 'search'])->name('blog.search');
    Route::post('enviar-newsletter', [NewsletterController::class, 'newsletter'])->name('send.newsletter');
    Route::post('enviar-contato', [ContactController::class, 'send'])->name('send.contact');
    Route::post('enviar-receita', [UploadController::class, 'send'])->name('send.receipt');
    Route::post('criar-farmacia', [PharmacyController::class, 'create']);
    Route::post('changeAddress/{id}', [UploadController::class, 'changeAddress'])->name('changeAddress');
    // Route::get('seja-um-parceiro', function () {
    //     return view('guest.seja-um-parceiro');
    // });

    Route::prefix('faq')->group(function() {
        Route::get('/', [HelpController::class, 'index'])->name('guest.faq');
        Route::get('{kind}', [HelpController::class, 'kind'])->name('guest.faq.inner');
    });
});

Route::post('/password-reset', [PasswordController::class, 'sendResetLink'])->name('reset.password');


Route::middleware(['auth'])->group(function () {
    Route::namespace('Admin')->group(function () {
        Route::prefix('dashboard')->group(function(){
            Route::get('/', [HomeController::class, 'index'])->name('dashboard');

            Route::prefix('profile')->group(function() {
                Route::get('/', [ProfileController::class, 'index'])->name('profile');
                Route::get('/parceiro', [PartnersController::class, 'showProfile'])->name('profile.partner');
                Route::post('/parceiro/update-account', [PartnersController::class, 'update'])->name('profile.update.partner');
                Route::post('/parceiro/update-address', [PartnersController::class, 'changeAddress'])->name('profile.update.address');
                Route::post('/parceiro/update-logo', [PartnersController::class, 'changeLogo'])->name('profile.update.logo');
                Route::post('update-account', [ProfileController::class, 'update'])->name('profile.update');
                Route::post('change-password', [ProfileController::class, 'changePassword'])->name('profile.password');
                Route::post('change-address', [ProfileController::class, 'changeAddress'])->name('profile.address');
                Route::post('change-picture', [ProfileController::class, 'changePicture'])->name('profile.picture');
                Route::post('delete-account', [ProfileController::class, 'removeAccount'])->name('profile.remove');
                Route::get('remove-address/{id}', [ProfileController::class, 'removeAddress'])->name('profile.removeAddress');
            });

            Route::prefix('informacoes-gerais')->group(function() {
                Route::get('/', [InfoGeralController::class, 'index'])->name('info');
                Route::post('edit', [InfoGeralController::class, 'edit'])->name('info.save');
            });
            
            Route::prefix('users')->group(function() {
                Route::get('/', [UsersController::class, 'index'])->name('users');
                Route::get('create', [UsersController::class, 'showCreate'])->name('users.create');
                Route::post('create', [UsersController::class, 'create'])->name('users.create.save');
                Route::get('view/{id}', [UsersController::class, 'view'])->name('users.view');
                Route::get('remove/{id}', [UsersController::class, 'remove'])->name('users.remove');
                Route::get('getUsers', [UsersController::class, 'getUsers'])->name('users.getUsers');
            });

            Route::prefix('partners')->group(function() {
                Route::get('/', [PartnersController::class, 'index'])->name('partners');
                Route::get('create', [PartnersController::class, 'showCreate'])->name('partners.create');
                Route::post('create', [PartnersController::class, 'create'])->name('partners.create.save');
                Route::get('remove/{id}', [PartnersController::class, 'remove'])->name('partners.remove');
                Route::get('getPartners', [PartnersController::class, 'getPartners'])->name('partners.getPartners');
                Route::get('edit/{id}', [PartnersController::class, 'edit'])->name('partners.edit');
                Route::post('edit/{id}/save', [PartnersController::class, 'editSave'])->name('partners.edit.save');
            });

            Route::prefix('contacts')->group(function() {
                Route::get('/', [AdminContactController::class, 'index'])->name('contact');
                Route::get('view/{id}')->name('contact.view');
                Route::get('remove/{id}')->name('contact.remove');
                Route::get('getContacts', [AdminContactController::class, 'getContacts'])->name('contact.getContacts');
            });

            Route::prefix('budgets')->group(function() {
                Route::get('/', [BudgetsController::class, 'index'])->name('budgets');
                Route::post('saveAnswer', [BudgetsController::class, 'sendBudget'])->name('budgets.sendAnswer');
                Route::get('inner/{id}', [BudgetsController::class, 'inner'])->name('budgets.inner');
                Route::post('updateStatus/{id}', [BudgetsController::class, 'updateStatus'])->name('budgets.updateStatus');
                Route::get('payment/{budgetId}', [PaymentController::class, 'index'])->name('budgets.accept');
                Route::post('payment/checkout', [PaymentController::class, 'checkout'])->name('budgets.checkout');
                Route::post('confirm-pix', [PaymentController::class, 'confirmPix'])->name('budgets.pix');
            });

            Route::prefix('posts')->group(function() {
                Route::get('/', [PostsController::class, 'index'])->name('blog');
                Route::get('new', [PostsController::class, 'new'])->name('blog.new');
                Route::post('new/save', [PostsController::class, 'save'])->name('blog.save');
                Route::get('remove/{slug}', [PostsController::class, 'remove'])->name('blog.remove');
                Route::get('edit/{id}', [PostsController::class, 'edit'])->name('blog.edit');
                Route::post('edit/{id}/save', [PostsController::class, 'editSave'])->name('blog.edit.save');

                Route::prefix('category')->group(function () {
                    Route::get('/', [PostsController::class, 'category'])->name('blog.category');
                    Route::get('new', [PostsController::class, 'newCategory'])->name('blog.category.new');
                    Route::post('new/save', [PostsController::class, 'saveCategory'])->name('blog.category.save');
                    Route::get('remove/{id}', [PostsController::class, 'removeCategory'])->name('blog.category.remove');
                    Route::get('edit/{id}', [PostsController::class, 'editCategory'])->name('blog.category.edit');
                    Route::post('edit/{id}/save', [PostsController::class, 'editSaveCategory'])->name('blog.category.edit.save');
                });
            });

            Route::prefix('testemonials')->group(function() {
                Route::get('/', [TestemonialController::class, 'index'])->name('testemonials');
                Route::get('new', [TestemonialController::class, 'new'])->name('testemonials.new');
                Route::post('new/save', [TestemonialController::class, 'save'])->name('testemonials.save');
                Route::get('edit/{id}', [TestemonialController::class, 'edit'])->name('testemonials.edit');
                Route::post('edit/{id}/save', [TestemonialController::class, 'editSave'])->name('testemonials.edit.save');
                Route::get('remove/{id}', [TestemonialController::class, 'remove'])->name('testemonials.remove');
            });

            Route::prefix('faq')->group(function() {
                Route::get('/', [FaqController::class, 'index'])->name('faq');
                Route::get('new', [FaqController::class, 'new'])->name('faq.new');
                Route::post('new/save', [FaqController::class, 'save'])->name('faq.save');
                Route::get('remove/{id}', [FaqController::class, 'remove'])->name('faq.remove');
                Route::get('edit/{id}', [FaqController::class, 'edit'])->name('faq.edit');
                Route::post('edit/{id}/save', [FaqController::class, 'editSave'])->name('faq.edit.save');
            });
            
            Route::prefix('paginas')->group(function() {
                Route::get('edit-home', [InfoHomeController::class, 'home'])->name('texts.home');
                Route::post('edit-home/save', [InfoHomeController::class, 'saveHome'])->name('texts.home.save');
                
                Route::get('edit-pet', [InfoPetController::class, 'pet'])->name('texts.pet');
                Route::post('edit-pet/save', [InfoPetController::class, 'savePet'])->name('texts.pet.save');
                
                Route::get('edit-about', [InfoAboutController::class, 'about'])->name('texts.about');
                Route::post('edit-about/save', [InfoAboutController::class, 'saveAbout'])->name('texts.about.save');
                
                Route::get('edit-contato', [InfoContatoController::class, 'contato'])->name('texts.contato');
                Route::post('edit-contato/save', [InfoContatoController::class, 'saveContato'])->name('texts.contato.save');
                
                Route::get('edit-blog', [InfoBlogController::class, 'blog'])->name('texts.blog');
                Route::post('edit-blog/save', [InfoBlogController::class, 'saveBlog'])->name('texts.blog.save');
                
                Route::get('edit-faq', [InfoFaqController::class, 'faq'])->name('texts.faq');
                Route::post('edit-faq/save', [InfoFaqController::class, 'saveFaq'])->name('texts.faq.save');
                
                Route::get('edit-parceiro', [InfoParceiroController::class, 'parceiro'])->name('texts.parceiro');
                Route::post('edit-parceiro/save', [InfoParceiroController::class, 'saveParceiro'])->name('texts.parceiro.save');
            });

            Route::prefix('texts')->group(function() {
                // Route::get('edit-home', [TextController::class, 'home'])->name('texts.home');
                // Route::post('edit-home/save', [TextController::class, 'saveHome'])->name('texts.home.save');

                // Route::get('edit-about', [TextController::class, 'about'])->name('texts.about');
                // Route::post('edit-about/save', [TextController::class, 'saveAbout'])->name('texts.about.save');

                // Route::get('edit-infos', [TextController::class, 'infos'])->name('texts.infos');
                // Route::post('edit-infos/save', [TextController::class, 'saveInfos'])->name('texts.infos.save');

                Route::get('edit-policy', [TextController::class, 'policy'])->name('texts.policy');
                Route::post('edit-policy/save', [TextController::class, 'savePolicy'])->name('texts.policy.save');

                Route::get('edit-terms', [TextController::class, 'terms'])->name('texts.terms');
                Route::post('edit-terms/save', [TextController::class, 'saveTerms'])->name('texts.terms.save');
            });
        });
    });
});

Route::get('test-email', function(Generator $faker) {

    return view('mail.resetPassword')->with([
        'name' => $faker->name(),
        'link' => $faker->safeEmail()
    ]);;
});

require __DIR__.'/auth.php';
