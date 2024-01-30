<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreIntegrationRequest;
use App\Http\Resources\Api\V1\IntegrationResource;
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

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
