<?php

namespace App\Providers;

use App\Models\Empresa;
use App\Models\Estagio;
use App\Repositories\Impl\EmpresaRepositoryImpl;
use App\Repositories\Impl\EstagioRepositoryImpl;
use App\Repositories\Interface\EmpresaRepository;
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

        $this->app->singleton(EmpresaRepository::class, function ($app) {
            return new EmpresaRepositoryImpl($this->app->make(Empresa::class));
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
