<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\Auth\ForgotPasswordController;

use App\Http\Controllers\Admin\{
    UserController,
    AdminController,
    LanguageController,
    RolesController,
    GeneralSettingsController,
    ConfigSettingsController,
    CurrencyController,
    PackageController,
    PaymentMethodController,
    ProfileController,
    SeoSettingController,
    AdminHomeController,
    ChooseController,
    CountryController,
    FaqController,
    MailTemplateController,
    ManualPaymentMethodController,
    PackageListController,
    PurchaseController,
    ServiceCategoryController,
    ServiceControlller,
    SupportTicketController,
};

Route::middleware(['prevent.back.history','admin.lang'])->prefix('admin')->name('admin.')->group(function(){
    /**
     * guest route with admin guard start
     */
    Route::middleware('guest:admin')->group(function(){

        //login controller
        Route::controller(LoginController::class)->group(function(){
            Route::get('/','showLoginForm')->name('login');
            Route::get('/default-captcha/{randCode}', 'defaultCaptcha')->name('captcha.genarate');
            Route::post('/login','login')->name('login.post');
        });

        //forgetpassword controller
        Route::controller(ForgotPasswordController::class)->group(function(){
            Route::get('/reset-password','showLinkRequestForm')->name('resetPassword');
            Route::post('/reset-password/post','sendResetLinkEmail')->name('resetpassword.post');
        });
        //reset password controller
        Route::controller(ResetPasswordController::class)->group(function(){
            Route::get('/update-password/{token}','index')->name('updatePassword');
            Route::post('/update-password','update')->name('updatePassword.post');
        });

    });

    Route::middleware(['auth:admin','auth.status'])->group(function(){
        //logout
        Route::controller(LoginController::class)->group(function(){
            Route::post('/logout','logout')->name('logout');
        });

        //home route
        Route::controller(AdminHomeController::class)->group(function(){
            Route::get('/dashboard','index')->name('home');
            Route::post('/read-notification','readNotification')->name('read.notification');
        });  

        //admin route
        Route::controller(AdminController::class)->group(function(){
            Route::get('/index','index')->name('index');
            Route::get('/create','create')->name('create');
            Route::post('/store','store')->name('store');
            Route::get('/edit/{id}','edit')->name('edit');
            Route::get('/show/{id}','show')->name('show');
            Route::post('/update','update')->name('update');
            Route::post('/status-update','statusUpdate')->name('status.update');
            Route::get('/status/{status}','statusData')->name('status');
            Route::post('/destroy','destroy')->name('destroy');
            Route::post('/mark','mark')->name('mark');
        });

        // country route
        Route::controller(CountryController::class)->name('country.')->prefix('country')->group(function(){
            Route::get('/index', 'index')->name('index');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/update', 'update')->name('update');
            Route::post('/destroy','destroy')->name('destroy');
            Route::post('/update/status', 'countryStatus')->name('update.status');
            Route::get('/status/{status}','statusData')->name('status');
            Route::post('/mark','mark')->name('mark');
        });

        // service category route
        Route::controller(ServiceCategoryController::class)->name('service.category.')->prefix('service/category')->group(function(){
            Route::get('/index', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/update', 'update')->name('update');
            Route::post('/destroy','destroy')->name('destroy');
            Route::post('/update/status', 'serviceCategoryStatus')->name('update.status');
            Route::get('/status/{status}','statusData')->name('status');
            Route::post('/mark','mark')->name('mark');
        });

        // service route
        Route::controller(ServiceControlller::class)->name('service.')->prefix('service')->group(function(){
            Route::get('/index', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/show/{id}', 'show')->name('show');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/update', 'update')->name('update');
            Route::post('/destroy','destroy')->name('destroy');
            Route::post('/update/status', 'serviceCategoryStatus')->name('update.status');
            Route::get('/status/{status}','statusData')->name('status');
            Route::post('/mark','mark')->name('mark');
        });

        // Purchase log route
        Route::controller(PurchaseController::class)->name('purchase.log.')->prefix('purchase/log')->group(function(){
            Route::get('/index', 'index')->name('index');
            Route::get('/show/{id}', 'show')->name('show');
            Route::post('/update', 'update')->name('update');
        });

        //package route
        Route::controller(PackageController::class)->prefix('package')->as('package.')->group(function(){
            Route::get('/index','index')->name('index');
            Route::get('/create','create')->name('create');
            Route::post('/store','store')->name('store');
            Route::get('/show/{id}', 'show')->name('show');
            Route::get('/edit/{id}','edit')->name('edit');
            Route::post('/update','update')->name('update');
            Route::post('/update-status','statusUpdate')->name('status.update');
            Route::post('/update-popular-status','popularUpdate')->name('popular.update');
            Route::post('/destroy','destroy')->name('destroy');
            Route::get('/status/{status}','statusData')->name('status');
            Route::post('/mark','mark')->name('mark');
        });

        //package list route
        Route::controller(PackageListController::class)->prefix('package/list')->as('package.list.')->group(function(){
            Route::get('/index','index')->name('index');
            Route::get('/create/{id}','create')->name('create');
            Route::post('/store','store')->name('store');
            Route::get('/show/{id}', 'show')->name('show');
            Route::get('/edit/{id}','edit')->name('edit');
            Route::post('/update','update')->name('update');
            Route::post('/update-status','statusUpdate')->name('status.update');
            Route::post('/destroy','destroy')->name('destroy');
            Route::get('/status/{status}','statusData')->name('status');
            Route::post('/mark','mark')->name('mark');
            Route::get('/details','details')->name('details');
        });

        // user route
         Route::controller(UserController::class)->prefix('user')->name('user.')->group(function(){
            Route::get('/index', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/show/{id}', 'show')->name('show');
            Route::post('/update-status', 'updateStatus')->name('updateStatus');
            Route::get('/status/{status}','statusData')->name('status');
            Route::get('/edit/{id}','edit')->name('edit');
            Route::post('/update','update')->name('update');
            Route::post('/destroy','destroy')->name('destroy');
            Route::post('/mark','mark')->name('mark');
        });


        // Manual payment route
         Route::controller(ManualPaymentMethodController::class)->prefix('payment/manual')->name('payment.manual.')->group(function(){
            Route::get('/index', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/show/{id}', 'show')->name('show');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/update', 'update')->name('update');
            Route::post('/destroy','destroy')->name('destroy');
            Route::post('/update/status', 'serviceCategoryStatus')->name('update.status');
            Route::get('/status/{status}','statusData')->name('status');
            Route::post('/mark','mark')->name('mark');
        });
        
        // choose route
         Route::controller(ChooseController::class)->prefix('choose')->name('choose.')->group(function(){
            Route::get('/index','index')->name('index');
            Route::get('/create','create')->name('create');
            Route::post('/store','store')->name('store');
            Route::get('/edit/{id}','edit')->name('edit');
            Route::post('/update','update')->name('update');
            Route::post('/update-status','statusUpdate')->name('status.update');
            Route::post('/destroy','destroy')->name('destroy');
            Route::get('/status/{status}','statusData')->name('status');
            Route::post('/mark','mark')->name('mark');
        });

        // faq route
         Route::controller(FaqController::class)->prefix('faq')->name('faq.')->group(function(){
            Route::get('/index','index')->name('index');
            Route::get('/create','create')->name('create');
            Route::post('/store','store')->name('store');
            Route::get('/show/{id}', 'show')->name('show');
            Route::get('/edit/{id}','edit')->name('edit');
            Route::post('/update','update')->name('update');
            Route::post('/update-status','statusUpdate')->name('status.update');
            Route::post('/destroy','destroy')->name('destroy');
            Route::get('/status/{status}','statusData')->name('status');
            Route::post('/mark','mark')->name('mark');
        });

        // mail template route
         Route::controller(MailTemplateController::class)->prefix('mail/template')->name('mail.template.')->group(function(){
            Route::get('/index','index')->name('index');
            Route::get('/edit/{id}','edit')->name('edit');
            Route::post('/update','update')->name('update');
            Route::post('/update-status','statusUpdate')->name('status.update');
            Route::post('/destroy','destroy')->name('destroy');
            Route::get('/status/{status}','statusData')->name('status');
            Route::post('/mark','mark')->name('mark');
        });

        // support ticket route
        Route::controller(SupportTicketController::class)->prefix('support/ticket')->name('support.ticket.')->group(function () {
            Route::get('/index', 'index')->name('index');
            Route::post('/reply/{id}', 'ticketReply')->name('reply');
            Route::post('/closed/{id}',  'closedTicket')->name('closed');
            Route::get('/running', 'running')->name('running');
            Route::get('/answered',  'answered')->name('answered');
            Route::get('/replied','replied')->name('replied');
            Route::get('/closeds', 'closeds')->name('closeds');
            Route::get('/detail/{id}',  'ticketDetails')->name('detail');
            Route::get('/download/{id}','supportTicketDownload')->name('file.download');
        });

        //language route
        Route::controller(LanguageController::class)->prefix('/language')->name('language.')->group(function(){
            Route::get('/index','index')->name('index');
            Route::get('/index-getData','translatableData')->name('get.translateData');
            Route::post('/store','store')->name('store');
            Route::post('/update','update')->name('update');
            Route::post('/status-update','statusUpdate')->name('status.update');
            Route::post('/default-status-update','setDefaultLang')->name('default.status.update');
            Route::post('/destroy','destroy')->name('destroy');
            Route::get('translate/{id}','translate')->name('translate');
            Route::post('translate-key','tranlateKey')->name('tranlateKey');
        });


        //profile route
        Route::controller(ProfileController::class)->prefix('profile')->as('profile.')->group(function(){
            Route::get('/','index')->name('index');
            Route::post('/update','update')->name('update');
            Route::post('/update-password','updatePassword')->name('password.update');
        });

        //roles route
        Route::controller(RolesController::class)->prefix('roles')->as('roles.')->group(function(){
            Route::get('/index','index')->name('index');
            Route::get('/create','create')->name('create');
            Route::post('/store','store')->name('store');
            Route::get('/edit/{id}','edit')->name('edit');
            Route::post('/update','update')->name('update');
            Route::post('/update-status','statusUpdate')->name('status.update');
            Route::post('/destroy','destroy')->name('destroy');
        });

        
        //currency route
        Route::controller(CurrencyController::class)->prefix('currency')->as('currency.')->group(function(){
            Route::get('/index','index')->name('index');
            Route::get('/create','create')->name('create');
            Route::post('/store','store')->name('store');
            Route::post('/update','update')->name('update');
            Route::post('/update-status','statusUpdate')->name('status.update');
            Route::post('/destroy','destroy')->name('destroy');
            Route::get('/status/{status}','statusData')->name('status');
        });

        //payment method route
        Route::controller(PaymentMethodController::class)->prefix('payment-method')->as('paymentMethod.')->group(function(){
            Route::post('/update','update')->name('update');
            Route::post('/update-status','statusUpdate')->name('status.update');
        });

        //settings route
        Route::prefix('settings')->as('settings.')->group(function(){
            Route::controller(GeneralSettingsController::class)->group(function(){
                //gen setting route start
                Route::get('/index','generalSettings')->name('index');
                Route::post('/update','generalSettingsUpdate')->name('update');
                Route::post('/update-countedBy','updateCountedBy')->name('countby');
                //gen setting route end
                Route::get('/payment/automatic','paymentMethod')->name('payment');
                // social media link route
                Route::get('/social-media', 'socialMediaLink')->name('socialMedia.link');
                Route::post('/socialMedia-update', 'socialMediaUpdate')->name('socialMedia.update');
                Route::post('/socialMedia-status', 'socialMediaStatus')->name('socialMedia.status');
                //mail config route start
                Route::get('/mail-config','mail')->name('mail');
                Route::post ('/test-mail','testMail')->name('test.mail');
                Route::post('/mail-config/update','mailConfigUpdate')->name('mailConfig.update');
                Route::post('/mail-status/update','mailStatusUpdate')->name('mail.status');
                //mail config route end

                //status update route start
                Route::post('/key-status/update','updateKeyStatus')->name('key.update');
                //status update route end

                //recaptcha  route start
                Route::get('/recaptcha','recaptcha')->name('recaptcha');
                Route::post('/recaptcha-update','recaptchaUpdate')->name('recaptcha.update');
                Route::post('/recaptcha-status-update','updateRecaptchaStatus')->name('recaptcha.status');
                //recaptcha  route end
                //social login route start
                Route::get('/social-login','mediaLogin')->name('media.login');
                Route::post('/social-login-update','mediaLoginUpdate')->name('media.login.update');
                Route::post('/social-login-status','mediaLoginStatusUpdate')->name('media.Login.status');
                //social login route end

            });
            Route::controller(ConfigSettingsController::class)->group(function(){
                Route::get('/config-optimize-clear','optimizeClear')->name('optimize.clear');
            });
        });

        //seo route start
        Route::controller(SeoSettingController::class)->prefix('seoSetting')->as('seoSetting.')->group(function(){
            Route::get('/index','index')->name('index');
            Route::get('/create','create')->name('create');
            Route::post('/store','store')->name('store');
            Route::get('/edit/{id}','edit')->name('edit');
            Route::post('/update','update')->name('update');
            Route::post('/destroy','destroy')->name('destroy');
        });
    });
});
