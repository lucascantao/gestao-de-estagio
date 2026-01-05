<?php

namespace App\Providers;

use App\Repositories\Interface\CompanyRepository;
use App\Repositories\Interface\InternshipRepository;
use App\Repositories\Interface\SkillRepository;
use App\Repositories\Interface\UserRepository;
use App\Repositories\Interface\VacanceRepository;
use App\Services\FileStorageService;
use App\Services\InternshipService;
use App\Services\SkillService;
use App\Services\UserService;
use App\Services\VacanceService;
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

        $this->app->singleton(VacanceService::class, function ($app) {
            return new VacanceService(
                $this->app->make(VacanceRepository::class),
                $this->app->make(CompanyRepository::class),
                $this->app->make(FileStorageService::class)
            );
        });

        $this->app->singleton(UserService::class, function ($app) {
            return new UserService(
                $this->app->make(UserRepository::class),
                $this->app->make(InternshipRepository::class)
            );
        });

        $this->app->singleton(SkillService::class, function ($app) {
            return new SkillService(
                $this->app->make(SkillRepository::class)
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
