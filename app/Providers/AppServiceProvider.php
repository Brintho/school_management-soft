<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        date_default_timezone_set('Asia/Dhaka');

        View::addNamespace('new', resource_path('views/app/backend'));

        View::addNamespace('layouts', resource_path('views/layouts'));
        View::addNamespace('backend', resource_path('views/app/backend'));
        View::addNamespace('core', resource_path('views/core'));
    }
}
