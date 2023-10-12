<?php

namespace App\Providers;

use App\Repositories\CartRepositoryInterface;
use App\Repositories\EloquentProductRepository;
use App\Repositories\ProductRepositoryInterface;
use App\Services\ProjectManagement\IProjectManagement;
use App\Services\ProjectManagement\LeantimeApiWrapper;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ProductRepositoryInterface::class, EloquentProductRepository::class);

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
