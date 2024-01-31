<?php

namespace App\Services\Models;

use App\Models\Integration;
use App\Repositories\Contracts\BaseRepositoryInterface;

class IntegrationService
{
    public mixed $integrationRepository;

    public function __construct()
    {
        $this->integrationRepository = app(BaseRepositoryInterface::class, [
            'model' => app(Integration::class),
        ]);
    }

    public function createIntegration(array $data)
    {
        return $this->integrationRepository->create($data);
    }

    public function updateIntegration(Integration $integration, array $data)
    {
        return $this->integrationRepository->update($integration->id, $data);
    }

    public function deleteIntegration(Integration $integration)
    {
        return $this->integrationRepository->delete($integration->id);
    }

    public function findIntegrationById(int $id)
    {
        return $this->integrationRepository->find($id);
    }
}
