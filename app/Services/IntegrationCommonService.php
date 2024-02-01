<?php

namespace App\Services;

use App\Enums\MarketplaceType;
use App\Exceptions\InvalidDataException;
use App\Exceptions\UnsuccessfulResponseException;
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

    /**
     * @throws InvalidDataException
     * @throws UnsuccessfulResponseException
     */
    public function createCommonIntegration(array $data)
    {
        $marketplaceType = MarketplaceType::tryFrom($data['marketplace']);
        if (!$marketplaceType)
            throw new InvalidDataException('Marketplace not found: ' . $data['marketplace']);

        $integrationData = [
            'username' => $data['username'],
            'password' => $data['password'],
        ];

        $response = $this->integrationManager->createIntegration($marketplaceType->adapter(), $integrationData);
        if (!$response['status'])
            throw new UnsuccessfulResponseException($response['message']);

        $marketplace = $this->marketplaceService->findMarketplaceByName($data['marketplace']);
        if (!$marketplace)
            throw new InvalidDataException('Marketplace model not found: ' . $data['marketplace']);

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
     * @throws UnsuccessfulResponseException
     */
    public function updateCommonIntegration(Integration $integration, array $data)
    {
        $integrationData = [];

        if (isset($data['username']))
            $integrationData['username'] = $data['username'];

        if (isset($data['password']))
            $integrationData['password'] = $data['password'];

        if (empty($integrationData))
            throw new InvalidDataException('Integration data is invalid');

        $marketplaceType = MarketplaceType::tryFrom($integration->marketplace->name);
        if (!$marketplaceType)
            throw new InvalidDataException('Marketplace not found: ' . $integration->marketplace->name);

        $response = $this->integrationManager->updateIntegration($marketplaceType->adapter(), $integration->reference, $integrationData);
        if (!$response['status'])
            throw new UnsuccessfulResponseException($response['message']);

        $integration = $this->integrationService->updateIntegration($integration, $integrationData);

        return $integration;
    }

    /**
     * @throws InvalidDataException
     * @throws UnsuccessfulResponseException
     */
    public function deleteCommonIntegration(Integration $integration): void
    {
        $marketplaceType = MarketplaceType::tryFrom($integration->marketplace->name);
        if (!$marketplaceType)
            throw new InvalidDataException('Marketplace not found: ' . $integration->marketplace->name);

        $response = $this->integrationManager->deleteIntegration($marketplaceType->adapter(), $integration->reference);
        if (!$response['status'])
            throw new UnsuccessfulResponseException($response['message']);

        $this->integrationService->deleteIntegration($integration);
    }
}
