<?php

namespace App\Providers;

use App\Interfaces\TaxRepositoryInterface;
use App\Repositories\Tax\Pph21Repository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Tax PPh 21 repository
        $this->app->bind(TaxRepositoryInterface::class, Pph21Repository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
