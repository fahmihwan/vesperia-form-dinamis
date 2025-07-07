<?php

namespace App\Providers;


use App\Repositories\Interfaces\FormRepositoryInterface;
use App\Repositories\Interfaces\PayloadRepositoryInterface;
use App\Repositories\PayloadRepository;
use App\Repositories\FormRepository;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(FormRepositoryInterface::class, FormRepository::class);
        $this->app->bind(PayloadRepositoryInterface::class, PayloadRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
