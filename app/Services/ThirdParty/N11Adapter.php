<?php

namespace App\Services\ThirdParty;

use App\Services\ThirdParty\Contracts\IntegrationInterface;
use App\Services\ThirdParty\Providers\N11;

class N11Adapter implements IntegrationInterface
{
    public N11 $library;

    public function __construct()
    {
        $this->library = new N11();
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
