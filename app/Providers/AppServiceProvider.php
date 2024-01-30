<?php

namespace App\Providers;

use App\Services\LoginService;
use App\Services\MarketplaceService;
use App\Services\UserService;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('UserService', UserService::class);
        $this->app->singleton('MarketplaceService', MarketplaceService::class);
        $this->app->singleton('LoginService', LoginService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        JsonResource::withoutWrapping();
    }
}
