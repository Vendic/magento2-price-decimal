<?php

declare(strict_types=1);

namespace Lillik\PriceDecimal\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;

interface ConfigInterface
{
    public function getScopeConfig(): ScopeConfigInterface;

    public function isEnable(): bool;

    public function canShowPriceDecimal(): bool;

    public function getPricePrecision(): int;
}
