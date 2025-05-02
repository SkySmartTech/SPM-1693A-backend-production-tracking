<?php

namespace App\Providers;

use App\Repositories\All\Color\ColorInterface;
use App\Repositories\All\Color\ColorRepository;
use App\Repositories\All\Size\SizeInterface;
use App\Repositories\All\Size\SizeRepository;
use App\Repositories\All\Style\StyleInterface;
use App\Repositories\All\Style\StyleRepository;
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
        $this->app->bind(ColorInterface::class, ColorRepository::class);
        $this->app->bind(SizeInterface::class, SizeRepository::class);
        $this->app->bind(StyleInterface::class, StyleRepository::class);

    }
}
