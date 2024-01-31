<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\MarketplaceType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreIntegrationRequest;
use App\Http\Requests\Api\V1\UpdateIntegrationRequest;
use App\Http\Resources\Api\V1\IntegrationResource;
use App\Models\Integration;
use App\Services\ThirdParty\N11Adapter;
use App\Services\ThirdParty\TrendyolAdapter;
use Illuminate\Http\Request;

class IntegrationController extends Controller
{
    public mixed $integrationService;

    public function __construct()
    {
        $this->integrationService = app('IntegrationService');
    }

    public function store(StoreIntegrationRequest $request): IntegrationResource
    {
        $data = $request->validated();
        $integration = $this->integrationService->createIntegration($data);

        return IntegrationResource::make($integration);
    }

    public function update(UpdateIntegrationRequest $request, Integration $integration): IntegrationResource
    {
        $data = $request->validated();
        $integration = $this->integrationService->updateIntegration($integration, $data);

        return IntegrationResource::make($integration);
    }

    public function destroy(Integration $integration): \Illuminate\Http\Response
    {
        $this->integrationService->deleteIntegration($integration);

        return response()->noContent();
    }
}
