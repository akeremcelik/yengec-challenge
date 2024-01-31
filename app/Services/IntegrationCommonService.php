<?php

namespace App\Services;

use App\Enums\MarketplaceType;
use App\Exceptions\InvalidDataException;
use App\Models\Integration;
use Illuminate\Support\Facades\Auth;

class IntegrationCommonService
{
    public mixed $integrationService;
    public mixed $integrationManager;
    public mixed $marketplaceService;

    public function __construct()
    {
        $this->integrationService = app('IntegrationService');
        $this->integrationManager = app('IntegrationManager');
        $this->marketplaceService = app('MarketplaceService');
    }

    public function createCommonIntegration(array $data)
    {
        $marketplaceType = MarketplaceType::from($data['marketplace']);

        $integrationData = [
            'username' => $data['username'],
            'password' => $data['password'],
        ];
        $response = $this->integrationManager->createIntegration($marketplaceType->adapter(), $integrationData);

        //

        $marketplace = $this->marketplaceService->findMarketplaceByName($data['marketplace']);

        $integrationData = array_merge($integrationData, [
            'marketplace_id' => $marketplace->id,
            'reference' => $response['reference'],
            'user_id' => Auth::user()?->id,
        ]);
        $integration = $this->integrationService->createIntegration($integrationData);

        return $integration;
    }

    /**
     * @throws InvalidDataException
     */
    public function updateCommonIntegration(Integration $integration, array $data)
    {
        $integrationData = [];

        if (isset($data['username']))
            $integrationData['username'] = $data['username'];

        if (isset($data['password']))
            $integrationData['password'] = $data['password'];

        if (empty($integrationData)) {
            throw new InvalidDataException('Integration data is invalid');
        }

        $marketplaceType = MarketplaceType::from($integration->marketplace->name);

        $this->integrationManager->updateIntegration($marketplaceType->adapter(), $integration->reference, $integrationData);
        $integration = $this->integrationService->updateIntegration($integration, $integrationData);

        return $integration;
    }

    public function deleteCommonIntegration(Integration $integration): void
    {
        $marketplaceType = MarketplaceType::from($integration->marketplace->name);
        $this->integrationManager->deleteIntegration($marketplaceType->adapter(), $integration->reference);

        $this->integrationService->deleteIntegration($integration);
    }
}
