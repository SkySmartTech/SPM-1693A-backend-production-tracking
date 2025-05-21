<?php

namespace App\Providers;

use App\Repositories\All\AssigneeLevel\AssigneeLevelInterface;
use App\Repositories\All\AssigneeLevel\AssigneeLevelRepository;
use App\Repositories\All\ComPermission\ComPermissionInterface;
use App\Repositories\All\ComPermission\ComPermissionRepository;
use App\Repositories\All\User\UserInterface;
use App\Repositories\All\User\UserRepository;
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
    public function boot(): void
    {
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(ComPermissionInterface::class, ComPermissionRepository::class);
        $this->app->bind(AssigneeLevelInterface::class, AssigneeLevelRepository::class);

    }
}
