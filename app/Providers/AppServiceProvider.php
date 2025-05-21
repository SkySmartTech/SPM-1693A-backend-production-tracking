<?php

namespace App\Providers;

use App\Http\Middleware\CheckUserAvailability;
use App\Repositories\All\Color\ColorInterface;
use App\Repositories\All\Color\ColorRepository;
use App\Repositories\All\Defect\DefectInterface;
use App\Repositories\All\Defect\DefectRepository;
use App\Repositories\All\Operation\OperationInterface;
use App\Repositories\All\Operation\OperationRepository;
use App\Repositories\All\Size\SizeInterface;
use App\Repositories\All\Size\SizeRepository;
use App\Repositories\All\Style\StyleInterface;
use App\Repositories\All\Style\StyleRepository;
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
        $this->app->bind(ColorInterface::class, ColorRepository::class);
        $this->app->bind(SizeInterface::class, SizeRepository::class);
        $this->app->bind(StyleInterface::class, StyleRepository::class);
        $this->app->bind(OperationInterface::class, OperationRepository::class);
        $this->app->bind(DefectInterface::class, DefectRepository::class);

    }
}
