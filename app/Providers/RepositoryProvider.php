<?php

namespace App\Providers;

use App\Models\Estagio;
use App\Repositories\Impl\EstagioRepositoryImpl;
use App\Repositories\Interface\EstagioRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(EstagioRepository::class, function ($app) {
            return new EstagioRepositoryImpl($this->app->make(Estagio::class));
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
