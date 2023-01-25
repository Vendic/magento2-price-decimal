<?php

declare(strict_types=1);

namespace Lillik\PriceDecimal\Model;

use Magento\Framework\App\CacheInterface;
use Magento\Framework\CurrencyInterface;
use Magento\Framework\Currency as MagentoCurrency;

/** @method getPricePrecision() */
class Currency extends MagentoCurrency implements CurrencyInterface
{
    use PricePrecisionConfigTrait;

    public function __construct(
        CacheInterface $appCache,
        public ConfigInterface $moduleConfig,
        $options = null,
        $locale = null
    ) {
        parent::__construct($appCache, $options, $locale);
    }
}
