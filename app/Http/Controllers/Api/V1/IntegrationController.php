<?php

namespace App\Http\Controllers\Api\V1;

use App\Exceptions\InvalidDataException;
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
        //
    }

    public function store(StoreIntegrationRequest $request): IntegrationResource
    {
        $data = $request->validated();
        $integration = $this->integrationCommonService->createCommonIntegration($data);

        return IntegrationResource::make($integration);
    }

    public function update(UpdateIntegrationRequest $request, Integration $integration): IntegrationResource
    {
        try {
            $data = $request->validated();
            $integration = $this->integrationCommonService->updateCommonIntegration($integration, $data);

            return IntegrationResource::make($integration);
        } catch (InvalidDataException $exception) {
            abort($exception->getCode(), $exception->getMessage());
        }
    }

    public function destroy(Integration $integration): \Illuminate\Http\Response
    {
        $this->integrationCommonService->deleteCommonIntegration($integration);

        return response()->noContent();
    }
}
