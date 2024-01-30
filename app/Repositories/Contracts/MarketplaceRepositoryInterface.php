<?php

namespace App\Repositories\Contracts;

interface MarketplaceRepositoryInterface
{
    public function findMarketplaceByName(string $name);
}
