<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Modules\Product\Repositories\CategoryRepository;
use App\Modules\Product\Repositories\CategoryRepositoryInterface;
use App\Modules\Product\Repositories\ProductRepository;
use App\Modules\Product\Repositories\ProductRepositoryInterface;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
    CategoryRepositoryInterface::class,
    CategoryRepository::class
);

    $this->app->bind(
        ProductRepositoryInterface::class,
        ProductRepository::class
    );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
