<?php

namespace App\Enums;

enum MarketplaceType: string
{
    case N11 = 'N11';
    case TRENDYOL = 'Trendyol';

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

            default:
                break;
        }

        return $adapter ?? null;
    }
}
