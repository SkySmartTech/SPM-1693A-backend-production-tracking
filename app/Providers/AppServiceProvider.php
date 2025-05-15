<?php

namespace App\Providers;

use App\Http\Middleware\CheckUserAvailability;
use App\Repositories\All\User\UserInterface;
use App\Repositories\All\User\UserRepository;
use App\Repositories\All\UserAccess\UserAccessInterface;
use App\Repositories\All\UserAccess\UserAccessRepository;
use App\Repositories\All\UserRole\UserRoleInterface;
use App\Repositories\All\UserRole\UserRoleRepository;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(Router $router): void
    {
        $router->aliasMiddleware('check.availability', CheckUserAvailability::class);
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(UserAccessInterface::class, UserAccessRepository::class);
        $this->app->bind(UserRoleInterface::class, UserRoleRepository::class);

    }
}
