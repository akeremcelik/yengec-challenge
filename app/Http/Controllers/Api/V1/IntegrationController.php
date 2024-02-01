<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreIntegrationRequest;
use App\Http\Requests\Api\V1\UpdateIntegrationRequest;
use App\Http\Resources\Api\V1\IntegrationResource;
use App\Models\Integration;
use App\Services\IntegrationCommonService;
use Illuminate\Http\Request;

class IntegrationController extends Controller
{
    public function __construct(public IntegrationCommonService $integrationCommonService)
    {
        $this->middleware('validate.integration.user')
            ->only('update', 'destroy');
    }

    public function store(StoreIntegrationRequest $request): IntegrationResource
    {
        try {
            $data = $request->validated();
            $integration = $this->integrationCommonService->createCommonIntegration($data);

            return IntegrationResource::make($integration);
        } catch (\Exception $exception) {
            abort($exception->getCode(), $exception->getMessage());
        }
    }

    public function update(UpdateIntegrationRequest $request, Integration $integration): IntegrationResource
    {
        try {
            $data = $request->validated();
            $integration = $this->integrationCommonService->updateCommonIntegration($integration, $data);

            return IntegrationResource::make($integration);
        } catch (\Exception $exception) {
            abort($exception->getCode(), $exception->getMessage());
        }
    }

    public function destroy(Integration $integration): \Illuminate\Http\Response
    {
        try {
            $this->integrationCommonService->deleteCommonIntegration($integration);
            return response()->noContent();
        } catch (\Exception $exception) {
            abort($exception->getCode(), $exception->getMessage());
        }
    }
}
