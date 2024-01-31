<?php

namespace App\Services\ThirdParty\Contracts;

interface IntegrationInterface
{
    public function createIntegration(array $data);
    public function updateIntegration(string $reference, array $data);
    public function deleteIntegration(string $reference);
}
