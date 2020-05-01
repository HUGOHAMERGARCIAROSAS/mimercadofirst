<?php

namespace App\Providers;

use App\src\Repositories\Contracts\CuponRepositoryInterface;
use App\src\Repositories\Contracts\ProductRepositoryInterface;
use App\src\Repositories\Contracts\UnidadRepositoryInterface;
use App\src\Repositories\CouponRepository;
use App\src\Repositories\ProductoRepository;
use App\src\Repositories\UnidadRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //$this->app->bind(
        //    ProductoRepositoryInterface::class,
        //    ProductoRepository::class
        //);
    }
}
