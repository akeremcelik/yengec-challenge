<?php

namespace App\Services\Models;

use App\Models\Integration;
use App\Repositories\Contracts\BaseRepositoryInterface;
use App\Repositories\Contracts\MarketplaceRepositoryInterface;

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
            'reference' => $data['reference'],
            'username' => $data['username'],
            'password' => $data['password'],
        ];

        return $this->integrationRepository->create($integrationData);
    }

    public function updateIntegration(Integration $integration, array $data)
    {
        return $this->integrationRepository->update($integration->id, $data);
    }

    public function deleteIntegration(Integration $integration)
    {
        return $this->integrationRepository->delete($integration->id);
    }
}
