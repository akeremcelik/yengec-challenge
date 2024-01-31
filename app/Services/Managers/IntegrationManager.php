<?php

namespace App\Services\Managers;

use App\Services\ThirdParty\Contracts\IntegrationInterface;

class IntegrationManager
{
    public function createIntegration(IntegrationInterface $integrationInterface, array $data)
    {
        return $integrationInterface->createIntegration($data);
    }

    public function updateIntegration(IntegrationInterface $integrationInterface, string $reference, array $data)
    {
        return $integrationInterface->updateIntegration($reference, $data);
    }

    public function deleteIntegration(IntegrationInterface $integrationInterface, string $reference)
    {
        return $integrationInterface->deleteIntegration($reference);
    }
}
