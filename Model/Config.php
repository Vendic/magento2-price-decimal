<?php

declare(strict_types=1);

namespace Lillik\PriceDecimal\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;

class Config implements ConfigInterface
{
    private const XML_PATH_PRICE_PRECISION = 'catalog_price_decimal/general/price_precision';
    private const XML_PATH_CAN_SHOW_PRICE_DECIMAL = 'catalog_price_decimal/general/can_show_decimal';
    private const XML_PATH_GENERAL_ENABLE = 'catalog_price_decimal/general/enable';

    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        private ScopeConfigInterface $scopeConfig
    ) {
    }

    public function getScopeConfig(): ScopeConfigInterface
    {
        return $this->scopeConfig;
    }

    /**
     * @return mixed
     */
    public function getValueByPath(string $path, string $scopeType = 'website')
    {
        return $this->getScopeConfig()->getValue($path, $scopeType);
    }

    public function isEnable(): bool
    {
        return (bool)$this->getValueByPath(self::XML_PATH_GENERAL_ENABLE);
    }

    public function canShowPriceDecimal(): bool
    {
        return (bool)$this->getValueByPath(self::XML_PATH_CAN_SHOW_PRICE_DECIMAL);
    }

    /**
     * Return Price precision from store config
     */
    public function getPricePrecision(): int
    {
        return (int)$this->getValueByPath(self::XML_PATH_PRICE_PRECISION);
    }
}
