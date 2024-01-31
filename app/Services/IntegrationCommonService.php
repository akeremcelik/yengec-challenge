<?php

namespace App\Services;

use App\Enums\MarketplaceType;
use App\Models\Integration;

class IntegrationCommonService
{
    public mixed $integrationService;
    public mixed $integrationManager;

    public function __construct()
    {
        $this->integrationService = app('IntegrationService');
        $this->integrationManager = app('IntegrationManager');
    }

    public function createIntegration(array $data)
    {
        $marketplaceType = MarketplaceType::from($data['marketplace']);

        $integrationManagerData = [
            'username' => $data['username'],
            'password' => $data['password'],
        ];
        $response = $this->integrationManager->createIntegration($marketplaceType->adapter(), $integrationManagerData);

        $integrationServiceData = $data;
        $integrationServiceData['reference'] = $response['reference'];
        $integration = $this->integrationService->createIntegration($integrationServiceData);

        return $integration;
    }

    public function updateIntegration(Integration $integration, array $data)
    {
        $marketplaceType = MarketplaceType::from($integration->marketplace->name);

        $integrationManagerData = [
            'username' => $data['username'],
            'password' => $data['password'],
        ];
        $response = $this->integrationManager->updateIntegration($marketplaceType->adapter(), $integration->reference, $integrationManagerData);

        $integrationServiceData = $data;
        $integration = $this->integrationService->updateIntegration($integration, $integrationServiceData);

        return $integration;
    }

    public function deleteIntegration(Integration $integration)
    {
        $marketplaceType = MarketplaceType::from($integration->marketplace->name);
        $response = $this->integrationManager->deleteIntegration($marketplaceType->adapter(), $integration->reference);

        $this->integrationService->deleteIntegration($integration);
    }
}
