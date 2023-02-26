<?php

namespace App\Providers;

use App\Http\Repositories\Eternal\GeneralRepository;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //bootstrap pagination
        Paginator::useBootstrap();
        //view share
        try {
            
            $view ['generalSetting'] = generalSetting();
            $view ['mailConfigs'] = mailConfig();
  
            View::share($view);
        } catch (\Exception $ex) {
        }

        Schema::defaultStringLength(191);

    }
}
