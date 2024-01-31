<?php

namespace App\Providers;

use App\Services\AuthService;
use App\Services\IntegrationCommonService;
use App\Services\Managers\IntegrationManager;
use App\Services\Models\IntegrationService;
use App\Services\Models\MarketplaceService;
use App\Services\Models\UserService;
use App\Services\ThirdParty\N11Adapter;
use App\Services\ThirdParty\TrendyolAdapter;
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
        $this->app->singleton('IntegrationService', IntegrationService::class);

        $this->app->singleton('AuthService', AuthService::class);
        $this->app->singleton('IntegrationCommonService', IntegrationCommonService::class);

        $this->app->singleton('N11Adapter', N11Adapter::class);
        $this->app->singleton('TrendyolAdapter', TrendyolAdapter::class);
        $this->app->singleton('IntegrationManager', IntegrationManager::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        JsonResource::withoutWrapping();
    }
}
