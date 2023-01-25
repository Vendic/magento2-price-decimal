<?php

declare(strict_types=1);

namespace Lillik\PriceDecimal\Model\Plugin;

use Magento\Directory\Model\PriceCurrency as SubjectPriceCurrency;
use Magento\Framework\Pricing\PriceCurrencyInterface;
use Magento\Framework\App\ScopeInterface;
use Magento\Framework\Model\AbstractModel;

class PriceCurrency extends PriceFormatPluginAbstract
{
    /**
     * @param SubjectPriceCurrency $subject
     * @param float|int $amount
     * @param bool $includeContainer
     * @param int $precision
     * @param null|string|bool|int|ScopeInterface $scope
     * @param AbstractModel|string|null $currency
     */
    public function beforeFormat(
        SubjectPriceCurrency $subject,
        $amount,
        bool $includeContainer = true,
        int $precision = PriceCurrencyInterface::DEFAULT_PRECISION,
        $scope = null,
        $currency = null
    ): array {
        if ($this->getConfig()->isEnable()) {
            // add the optional arg
            if (!$includeContainer) {
                $includeContainer = true;
            }
            // Precision argument
            $precision = $this->getPricePrecision();
        }

        return [$amount, $includeContainer, $precision, $scope, $currency];
    }

    public function aroundRound(
        SubjectPriceCurrency $subject,
        callable $proceed,
        float $price
    ): float {
        if ($this->getConfig()->isEnable()) {
//            if (is_string($price)) {
//                $price = floatval($price);
//            }

            return round($price, $this->getPricePrecision());
        } else {
            return $proceed($price);
        }
    }

    /**
     * @param SubjectPriceCurrency $subject
     * @param float|int $amount
     * @param bool $includeContainer
     * @param int $precision
     * @param null|string|bool|int|ScopeInterface $scope
     * @param AbstractModel|string|null $currency
     * @return array
     */
    public function beforeConvertAndFormat(
        SubjectPriceCurrency $subject,
        $amount,
        bool $includeContainer = true,
        int $precision = PriceCurrencyInterface::DEFAULT_PRECISION,
        $scope = null,
        $currency = null
    ): array {
        if ($this->getConfig()->isEnable()) {
            $precision = (int)$this->getPricePrecision();
        }

        return [$amount, $includeContainer, $precision, $scope, $currency];
    }

    /**
     * @param SubjectPriceCurrency $subject
     * @param float|int $amount
     * @param null|string|bool|int|ScopeInterface $scope
     * @param AbstractModel|string|null $currency
     * @param int $precision
     * @return array
     */
    public function beforeConvertAndRound(
        SubjectPriceCurrency $subject,
        $amount,
        $scope = null,
        $currency = null,
        int $precision = PriceCurrencyInterface::DEFAULT_PRECISION
    ): array {
        if ($this->getConfig()->isEnable()) {
            $precision = $this->getPricePrecision();
        }

        return [$amount, $scope, $currency, $precision];
    }
}
