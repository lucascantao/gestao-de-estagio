<?php

namespace App\Providers;

use App\Models\Estagio;
use App\Repositories\Impl\EstagioRepositoryImpl;
use App\Repositories\Interface\EstagioRepository;
use App\Services\EstagioService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(EstagioService::class, function ($app) {
            return new EstagioService(
                $this->app->make(EstagioRepository::class)
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
