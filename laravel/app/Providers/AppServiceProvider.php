<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Modules\Product\Repositories\CategoryRepository;
use App\Modules\Product\Repositories\CategoryRepositoryInterface;
use App\Modules\Product\Repositories\ProductRepository;
use App\Modules\Product\Repositories\ProductRepositoryInterface;
use App\Modules\Supplier\Repositories\SupplierRepository;
use App\Modules\Supplier\Repositories\SupplierRepositoryInterface;
use App\Modules\Purchase\Repositories\PurchaseRepository;
use App\Modules\Purchase\Repositories\PurchaseRepositoryInterface;
use App\Modules\Transaction\Repositories\TransactionRepository;
use App\Modules\Transaction\Repositories\TransactionRepositoryInterface;
use App\Modules\Customer\Repositories\CustomerRepository;
use App\Modules\Customer\Repositories\CustomerRepositoryInterface;

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

    $this->app->bind(
        SupplierRepositoryInterface::class,
        SupplierRepository::class
    );

    $this->app->bind(
    PurchaseRepositoryInterface::class,
    PurchaseRepository::class
    );

    $this->app->bind(
    TransactionRepositoryInterface::class,
    TransactionRepository::class
    );

    $this->app->bind(
        CustomerRepositoryInterface::class,
        CustomerRepository::class
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
