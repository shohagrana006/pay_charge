<?php

use App\Http\Controllers\Auth\AuthenticateController;
use App\Http\Controllers\Auth\SocialLoginController;
use App\Http\Controllers\General\GeneralController;
use App\Http\Controllers\PaymentMethod\RazorpayPaymentController;
use App\Http\Controllers\PaymentMethod\SslCommerzPaymentController;
use App\Http\Controllers\PaymentMethod\StripePaymentController;
use App\Http\Controllers\PaymentMethod\PaystackPayment;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\User\
{
    HomeController,
    PackageListController,
    PaymentController,
    PaymentLogController,
    ProfileController,
    PurchaseController,
    SupportTicketController,
};


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



    Auth::routes();
    
    //welcome blade
    Route::get('/', function(){
        return view('welcome');
    })->name('home');
    
    //image make route start
    Route::get('/make/image/{size}', [GeneralController::class, 'createImage'])->name('make.image');
    //change system language
    Route::get('/change/language/{code}', [GeneralController::class, 'changeLanguage'])->name('change.language');
    //download site map
    Route::get('/download-sitemap', [GeneralController::class, 'siteMap'])->name('siteMap.download');

    //home route
    Route::middleware(['prevent.back.history'])->prefix('user')->name('user.')->group(function(){

        Route::middleware('guest:web')->group(function () {
            //login controller
            Route::controller(AuthenticateController::class)->group(function () {                
                Route::get('/default-captcha/{randCode}', 'defaultCaptcha')->name('captcha.genarate');

                Route::get('/login', 'showLoginForm')->name('login');
                Route::post('/login/post', 'login')->name('login.post');

                Route::get('/register', 'showRegisterForm')->name('register');
                Route::post('/register/post', 'register')->name('register.post');

                Route::get('/otp/verify/form/{token?}','otpVerifyForm')->name('otp.verify.form');
                Route::post('/otp/verify','otpVerify')->name('otp.verify');
                Route::get('/otp/resend/{token?}','otpResend')->name('otp.resend');
            });

            // social login controller
            Route::controller(SocialLoginController::class)->group(function () {
                Route::get('login/{social}', 'redirectToOauth')->name('social.login');
                Route::get('login/{social}/callback', 'handleOauthCallback')->name('social.login.callback');
            });

        });


        // auth  route with web guard start
        Route::middleware(['auth:web','auth.user.status' ])->group(function(){
            //logout
            Route::controller(AuthenticateController::class)->group(function () {
                Route::post('/logout', 'logout')->name('logout');
            });

            // user dashboard
            Route::controller(HomeController::class)->group(function () {
                Route::get('/dashboard', 'dashboard')->name('dashboard');
            });

            //profile route
            Route::controller(ProfileController::class)->prefix('profile')->as('profile.')->group(function(){
                Route::get('/','index')->name('index');
                Route::post('/update','update')->name('update');
                Route::post('/update-password','updatePassword')->name('password.update');
            });


            // package route
            Route::controller(PackageListController::class)->name('package.')->prefix('package')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::post('/package-service/{type}', 'service')->name('service');
                Route::get('/package-service-list/{id}', 'ServiceList')->name('service.list');
            });

            // Support route
            Route::controller(SupportTicketController::class)->name('support.ticket.')->prefix('support/ticket')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create','create')->name('create');
                Route::post('/store','store')->name('store');
                Route::get('/detail/{id}', 'detail')->name('detail');
                Route::post('/reply/{id}', 'ticketReply')->name('reply');
                Route::post('/closed/{id}','closedTicket')->name('closed');
                Route::get('/file/download/{id}', 'supportTicketDownload')->name('file.download');
            });

            // Purchase route
            Route::controller(PurchaseController::class)->name('purchase.')->prefix('purchase')->group(function () {
                Route::get('/detail/{id}', 'detail')->name('detail');
                Route::post('/buy', 'buy')->name('buy');
            });

            // Purchase log route-na
            Route::controller(PurchaseController::class)->name('purchase.log.')->prefix('purchase/log')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/show/{id}', 'show')->name('show');
                Route::post('/delete', 'delete')->name('delete');
            });

            // payment route
            Route::controller(PaymentController::class)->prefix('payment')->as('payment.')->group(function () {
                Route::get('/list', 'list')->name('list');
                Route::get('/automatic/preview/{id}', 'automaticPreview')->name('automatic.preview');
                Route::post('/automatic/confirm', 'paymentConfirm')->name('automatic.confirm');
                Route::get('/manual/preview/{id}', 'manualPreview')->name('manual.preview');
            });
            // payment log route
            Route::controller(PaymentLogController::class)->prefix('payment/log')->as('payment.log.')->group(function () {
                Route::post('/post', 'post')->name('post');              
            });



            Route::prefix('ipn')->group(function () {

                Route::get('/flutterwave/{trx}/{type}', [FlutterwavePaymentController::class,'callback'])->name('flutterwave.callback');
                //instamojo
                Route::post('instamojo', [InstamojoPaymentController::class, 'pay']);
                Route::get('instamojo/success', [InstamojoPaymentController::class, 'success']);
                //paypal
                Route::post('paypal', [PaypalPaymentController::class, 'postPaymentWithpaypal'])->name('paypal');
                Route::get('paypal/status', [PaypalPaymentController::class, 'getPaymentStatus'])->name('paypal.status');
                //paystack
                Route::get('paystack', [PaystackPayment::class, 'store'])->name('paystack');
                //SslCommerz
                Route::post('ssl/store', [SslCommerzPaymentController::class, 'index'])->name('sslcommerz.store');
                Route::get('success', [SslCommerzPaymentController::class, 'success']);
                Route::get('fail', [SslCommerzPaymentController::class, 'fail']);
                Route::post('cancel', [SslCommerzPaymentController::class, 'cancel']);
                Route::post('/', [SslCommerzPaymentController::class, 'ipn']);
                //strip
                Route::post('stripe', [StripePaymentController::class, 'stripePost'])->name('stripe');
                //Razorpay
                Route::post('/razorpay', [RazorpayPaymentController::class, 'store'])->name('razorpay.store');

                //paytm,
                Route::post('/paytm/process', [PaymentWithPaytm::class,'getTransactionToken'])->name('paytm.process');
                Route::post('/paytm/callback/', [PaymentWithPaytm::class,'ipn'])->name('paytm.ipn');
                // instamojo
                Route::get('/instamojo', [PaymentWithInstamojo::class,'process'])->name('instamojo');
                Route::get('/instamojo/callback', [PaymentWithInstamojo::class,'ipn'])->name('ipn.instamojo');
            });


            
        });
    });

    Route::fallback(function () {
        return view('error.index');
    })->name('error');


