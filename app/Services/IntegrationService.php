<?php

namespace App\Services;

use App\Models\Integration;
use App\Repositories\Contracts\BaseRepositoryInterface;
use App\Repositories\Contracts\MarketplaceRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class IntegrationService
{
    public mixed $integrationRepository;
    public mixed $marketplaceRepository;

    public function __construct()
    {
        $this->integrationRepository = app(BaseRepositoryInterface::class, [
            'model' => app(Integration::class),
        ]);
        $this->marketplaceRepository = app(MarketplaceRepositoryInterface::class);
    }

    public function createIntegration(array $data)
    {
        $marketplace = $this->marketplaceRepository->findMarketplaceByName($data['marketplace']);

        $integrationData = [
            'marketplace_id' => $marketplace->id,
            'user_id' => Auth::user()->id,
            'username' => $data['username'],
            'password' => $data['password'],
        ];

        return $this->integrationRepository->create($integrationData);
    }
}
