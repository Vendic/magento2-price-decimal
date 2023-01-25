<?php

declare(strict_types=1);

namespace Lillik\PriceDecimal\Model;

use Lillik\PriceDecimal\Model\ConfigInterface;

trait PricePrecisionConfigTrait
{
    public function getConfig(): ConfigInterface
    {
        return $this->moduleConfig;
    }

    public function getPricePrecision(): int
    {
        if ($this->getConfig()->canShowPriceDecimal()) {
            return $this->getConfig()->getPricePrecision();
        }

        return 0;
    }
}
