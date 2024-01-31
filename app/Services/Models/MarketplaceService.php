<?php

namespace App\Services\Models;

use App\Repositories\Contracts\MarketplaceRepositoryInterface;

class MarketplaceService
{
    public mixed $marketplaceRepository;

    public function __construct()
    {
        $this->marketplaceRepository = app(MarketplaceRepositoryInterface::class);
    }

    public function createMarketplace(string $name)
    {
        $data = [
            'name' => $name,
        ];

        return $this->marketplaceRepository->create($data);
    }

    public function findMarketplaceByName(string $name)
    {
        return $this->marketplaceRepository->findMarketplaceByName($name);
    }
}
