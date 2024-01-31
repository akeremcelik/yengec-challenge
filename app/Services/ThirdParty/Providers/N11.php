<?php

namespace App\Services\ThirdParty\Providers;

class N11
{
    public function saveIntegration(array $data): array
    {
        return [
            'status' => true,
            'reference' => $this->reference(),
        ];
    }

    public function modifyIntegration(int $reference, array $data): array
    {
        return [
            'status' => true,
        ];
    }

    public function destroyIntegration(int $reference): array
    {
        return [
            'status' => true,
        ];
    }

    protected function reference(): string
    {
        return 'n11_' . time();
    }
}
