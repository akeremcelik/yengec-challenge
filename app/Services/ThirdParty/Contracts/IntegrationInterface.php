<?php

namespace App\Services\ThirdParty\Contracts;

interface IntegrationInterface
{
    public function createIntegration(array $data);
    public function updateIntegration(int $reference, array $data);
    public function deleteIntegration(int $reference);
}
