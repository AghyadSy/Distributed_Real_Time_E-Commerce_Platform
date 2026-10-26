<?php

namespace App\Providers;
use App\Modules\Identity\Application\Contracts\JwtAuthenticationContract;
use App\Modules\Identity\Application\Contracts\UserRepositoryInterface;
use App\Modules\Identity\Infrastructure\Authentication\JwtAuthenticationService;
use App\Modules\Identity\Infrastructure\Persistence\EloquentUserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
        UserRepositoryInterface::class,
        EloquentUserRepository::class
        );

        $this->app->bind(
            JwtAuthenticationContract::class,
            JwtAuthenticationService::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
