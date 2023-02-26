<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\
{
    AdminController,
    AuthController,
    ChooseController,
    CountryController,
    dashboardController,
    FaqController,
    LanguageController,
    ManualPaymentMethodController,
    OAuthController,
    PackageController,
    PackageListController,
    PackageServiceController,
    ServiceCategoryController,
    ServiceController,
    UserController,
};
use App\Http\Controllers\General\GeneralController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware('api.lang')->prefix('v1')->group(function(){

    // auth route
    Route::group(['as' => 'auth'], function(){
        Route::post('register', [AuthController::class, 'register'])->name('register');
        Route::get('user/account/verify/{token}', [AuthController::class, 'userAccountVerify'])->name('user.account.active');
        Route::post('login', [AuthController::class, 'login'])->name('login');
    });

    // google oauth route
    Route::get('google/redirect', [OAuthController::class, 'googleReditect']);
    Route::get('google/callback-url', [OAuthController::class, 'googleCallback']);
    
    // admin route
    Route::group(['prefix' => 'admin','as' => 'admin'], function(){
        Route::get('index/{id?}', [AdminController::class, 'index'])->name('index');
    });
    
    // user route
    Route::group(['prefix' => 'user','as' => 'user'], function(){
        Route::get('index/{id?}', [UserController::class, 'index'])->name('index');
    });
    
    // country route
    Route::group(['prefix' => 'country','as' => 'country'], function(){
        Route::get('index/{id?}', [CountryController::class, 'index'])->name('index');
    });

    // service category route
    Route::group(['prefix' => 'category','as' => 'category'], function(){
        Route::get('index/{id?}', [ServiceCategoryController::class, 'index'])->name('index');
    });

    // service route
    Route::group(['prefix' => 'service','as' => 'service'], function(){
        Route::get('index/{id?}', [ServiceController::class, 'index'])->name('index');
    });

    // package route
    Route::group(['prefix' => 'package/service','as' => 'package.service'], function(){
        Route::get('index/{id}', [PackageServiceController::class, 'index'])->name('index');
    });

    // package route
    Route::group(['prefix' => 'package','as' => 'package'], function(){
        Route::get('index/{id?}', [PackageController::class, 'index'])->name('index');
    });

    // package list route
    Route::group(['prefix' => 'package/list','as' => 'package.list'], function(){
        Route::get('index/{id?}', [PackageListController::class, 'index'])->name('index');
    });

    // language route
    Route::group(['prefix' => 'language','as' => 'language'], function(){
        Route::get('index/{id?}', [LanguageController::class, 'index'])->name('index');
        Route::get('/change/{code}', [LanguageController::class, 'changeLanguage'])->name('change');
        Route::get('/locale', [LanguageController::class, 'locale'])->name('locale');
    });

    // choose list route
    Route::group(['prefix' => 'choose', 'as' => 'choose'], function () {
        Route::get('index/{id?}', [ChooseController::class, 'index'])->name('index');
    });
    
    // choose list route
    Route::group(['prefix' => 'faq', 'as' => 'faq'], function () {
        Route::get('index/{id?}', [FaqController::class, 'index'])->name('index');
    });







    // auth api route group
    Route::middleware('auth:api')->group(function(){

        // user logout route
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');

        // dashboard route
        Route::group(['prefix' => 'dashboard','as' => 'dashboard'], function(){
            Route::get('index', [dashboardController::class, 'index'])->name('index');
        });
        
        // manual payment route
        Route::group(['prefix' => 'manual/payment','as' => 'manual.payment'], function(){
            Route::get('index/{id?}', [ManualPaymentMethodController::class, 'index'])->name('index');
        });

        
    });






});