<?php

namespace App\Services\ThirdParty;

use App\Services\ThirdParty\Contracts\IntegrationInterface;
use App\Services\ThirdParty\Providers\n11;

class N11Adapter implements IntegrationInterface
{
    public n11 $library;

    public function __construct()
    {
        $this->library = new n11();
    }

    public function createIntegration(array $data): array
    {
        return $this->library->saveIntegration($data);
    }

    public function updateIntegration(int $reference, array $data): array
    {
        return $this->library->modifyIntegration($reference, $data);
    }

    public function deleteIntegration(int $reference): array
    {
        return $this->library->destroyIntegration($reference);
    }
}
