<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\MarketplaceType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreIntegrationRequest;
use App\Http\Requests\Api\V1\UpdateIntegrationRequest;
use App\Http\Resources\Api\V1\IntegrationResource;
use App\Models\Integration;
use Illuminate\Http\Request;

class IntegrationController extends Controller
{
    public mixed $integrationService;
    public mixed $integrationManager;

    public function __construct()
    {
        $this->integrationService = app('IntegrationService');
        $this->integrationManager = app('IntegrationManager');
    }

    public function store(StoreIntegrationRequest $request): IntegrationResource
    {
        $data = $request->validated();
        $marketplaceType = MarketplaceType::from($data['marketplace']);

        $integrationManagerData = [
            'username' => $data['username'],
            'password' => $data['password'],
        ];
        $response = $this->integrationManager->createIntegration($marketplaceType->adapter(), $integrationManagerData);

        $integrationServiceData = $data;
        $integrationServiceData['reference'] = $response['reference'];
        $integration = $this->integrationService->createIntegration($integrationServiceData);

        return IntegrationResource::make($integration);
    }

    public function update(UpdateIntegrationRequest $request, Integration $integration): IntegrationResource
    {
        $data = $request->validated();
        $marketplaceType = MarketplaceType::from($integration->marketplace->name);

        $integrationManagerData = [
            'username' => $data['username'],
            'password' => $data['password'],
        ];
        $response = $this->integrationManager->updateIntegration($marketplaceType->adapter(), $integration->reference, $integrationManagerData);

        $integrationServiceData = $data;
        $integration = $this->integrationService->updateIntegration($integration, $integrationServiceData);

        return IntegrationResource::make($integration);
    }

    public function destroy(Integration $integration): \Illuminate\Http\Response
    {
        $marketplaceType = MarketplaceType::from($integration->marketplace->name);
        $response = $this->integrationManager->updateIntegration($marketplaceType->adapter(), $integration->reference);

        $this->integrationService->deleteIntegration($integration);

        return response()->noContent();
    }
}
