<?php

namespace App\Providers;

use App\Repositories\Impl\ProductRepositoryImpl;
use App\Repositories\ProductRepository;
use App\Services\Impl\ProductServiceImpl;
use App\Services\ProductService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class ProductServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ProductRepository::class, ProductRepositoryImpl::class);
        $this->app->singleton(ProductService::class, ProductServiceImpl::class);
    }

    public function provides(): array
    {
        return [
            ProductRepository::class,
            ProductService::class
        ];
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
