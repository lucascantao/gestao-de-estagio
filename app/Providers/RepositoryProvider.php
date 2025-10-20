<?php

namespace App\Providers;

use App\Models\CompanyModel;
use App\Models\InternshipModel;
use App\Repositories\Impl\CompanyRepositoryImpl;
use App\Repositories\Impl\InternshipRepositoryImpl;
use App\Repositories\Interface\CompanyRepository;
use App\Repositories\Interface\InternshipRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(InternshipRepository::class, function ($app) {
            return new InternshipRepositoryImpl($this->app->make(InternshipModel::class));
        });

        $this->app->singleton(CompanyRepository::class, function ($app) {
            return new CompanyRepositoryImpl($this->app->make(CompanyModel::class));
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
