<?php

namespace App\Services\Managers;

use App\Services\ThirdParty\Contracts\IntegrationInterface;

class IntegrationManager
{
    public function createIntegration(IntegrationInterface $integrationInterface, array $data)
    {
        return $integrationInterface->createIntegration($data);
    }

    public function updateIntegration(IntegrationInterface $integrationInterface, int $reference, array $data)
    {
        return $integrationInterface->updateIntegration($reference, $data);
    }

    public function deleteIntegration(IntegrationInterface $integrationInterface, int $reference)
    {
        return $integrationInterface->deleteIntegration($reference);
    }
}
