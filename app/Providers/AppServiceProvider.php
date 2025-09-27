<?php

namespace App\Providers;

use App\Business\Repositories\Contracts\CategoryRepositoryInterface;
use App\Business\Repositories\Contracts\ProductRepositoryInterface;
use App\Business\Repositories\Eloquent\Product\CategoryRepository;
use App\Business\Repositories\Eloquent\Product\ProductRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ProductRepositoryInterface::class,ProductRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class,CategoryRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
