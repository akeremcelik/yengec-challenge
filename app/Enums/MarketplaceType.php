<?php

namespace App\Enums;

enum MarketplaceType: string
{
    case N11 = 'n11';
    case TRENDYOL = 'trendyol';

    public function adapter()
    {
        switch ($this)
        {
            case self::N11:
                $adapter = app('N11Adapter');
                break;

            case self::TRENDYOL:
                $adapter = app('TrendyolAdapter');
                break;
        }

        return $adapter ?? null;
    }
}
