<?php

namespace App\Providers;

use App\Repositories\Interface\CompanyRepository;
use App\Repositories\Interface\InternshipRepository;
use App\Repositories\Interface\UserRepository;
use App\Services\FileStorageService;
use App\Services\InternshipService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(InternshipService::class, function ($app) {
            return new InternshipService(
                $this->app->make(InternshipRepository::class),
                $this->app->make(CompanyRepository::class),
                $this->app->make(FileStorageService::class)
            );
        });

        $this->app->singleton(UserService::class, function ($app) {
            return new UserService(
                $this->app->make(UserRepository::class),
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
