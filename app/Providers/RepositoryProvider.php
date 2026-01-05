<?php

namespace App\Providers;

use App\Models\CompanyModel;
use App\Models\InternshipModel;
use App\Models\SkillModel;
use App\Models\UserModel;
use App\Models\VacanceModel;
use App\Repositories\Impl\CompanyRepositoryImpl;
use App\Repositories\Impl\InternshipRepositoryImpl;
use App\Repositories\Impl\SkillRepositoryImpl;
use App\Repositories\Impl\UserRepositoryImpl;
use App\Repositories\Impl\VacanceRepositoryImpl;
use App\Repositories\Interface\CompanyRepository;
use App\Repositories\Interface\InternshipRepository;
use App\Repositories\Interface\SkillRepository;
use App\Repositories\Interface\UserRepository;
use App\Repositories\Interface\VacanceRepository;
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

        $this->app->singleton(VacanceRepository::class, function ($app) {
            return new VacanceRepositoryImpl($this->app->make(VacanceModel::class));
        });

        $this->app->singleton(CompanyRepository::class, function ($app) {
            return new CompanyRepositoryImpl($this->app->make(CompanyModel::class));
        });

        $this->app->singleton(UserRepository::class, function ($app) {
            return new UserRepositoryImpl($this->app->make(UserModel::class));
        });

        $this->app->singleton(SkillRepository::class, function ($app) {
            return new SkillRepositoryImpl($this->app->make(SkillModel::class));
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
