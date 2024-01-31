<?php

namespace App\Services\Models;

use App\Models\Marketplace;
use App\Repositories\Contracts\BaseRepositoryInterface;

class MarketplaceService
{
    public mixed $marketplaceRepository;

    public function __construct()
    {
        $this->marketplaceRepository = app(BaseRepositoryInterface::class, [
            'model' => app(Marketplace::class),
        ]);
    }

    public function createMarketplace(string $name)
    {
        $data = [
            'name' => $name,
        ];

        return $this->marketplaceRepository->create($data);
    }
}
