<?php

namespace App\Services\ThirdParty\Providers;

class N11
{
    public function saveIntegration(array $data): array
    {
        return [
            'SaveIntegrationResponse' => [
                'status' => true,
                'n11_reference' => $this->reference(),
            ],
        ];
    }

    public function modifyIntegration(string $reference, array $data): array
    {
        return [
            'ModifyIntegrationResponse' => [
                'status' => true,
            ],
        ];
    }

    public function destroyIntegration(string $reference): array
    {
        return [
            'DestroyIntegrationResponse' => [
                'status' => true,
            ],
        ];
    }

    protected function reference(): string
    {
        return 'n11_' . time();
    }
}
