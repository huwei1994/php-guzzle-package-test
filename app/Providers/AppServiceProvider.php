<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\AppNoticeModel;
use App\Observer\AppNoticeObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        AppNoticeModel::observe(AppNoticeObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
