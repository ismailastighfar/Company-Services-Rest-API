<?php

namespace App\Providers;

use App\Interfaces\ServiceRepositoryInterface;
use App\Interfaces\ServiceServiceInterface;
use App\Mappers\ServiceMapper;
use App\Repositories\ServiceRepository;
use App\Services\ServiceService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ServiceRepositoryInterface::class,ServiceRepository::class);
        $this->app->bind(ServiceServiceInterface::class, ServiceService::class);
        $this->app->bind(ServiceMapper::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
