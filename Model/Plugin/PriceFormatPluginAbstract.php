<?php

declare(strict_types=1);

namespace Lillik\PriceDecimal\Model\Plugin;

use Lillik\PriceDecimal\Model\ConfigInterface;
use Lillik\PriceDecimal\Model\PricePrecisionConfigTrait;

abstract class PriceFormatPluginAbstract
{
    use PricePrecisionConfigTrait;
    public function __construct(
        protected ConfigInterface $moduleConfig
    ) {
    }
}
