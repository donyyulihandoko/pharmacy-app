<?php

namespace App\Providers;

use App\Repositories\CategoryRepository;
use App\Repositories\Impl\CategoryRepositoryImpl;
use App\Services\CategoryService;
use App\Services\Impl\CategoryServiceImpl;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class CategoryServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CategoryRepository::class, CategoryRepositoryImpl::class);
        $this->app->singleton(CategoryService::class, CategoryServiceImpl::class);
    }

    public function provides(): array
    {
        return [
            CategoryService::class,
            CategoryRepository::class
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
