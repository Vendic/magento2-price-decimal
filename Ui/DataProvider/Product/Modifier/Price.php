<?php

declare(strict_types=1);

namespace Lillik\PriceDecimal\Ui\DataProvider\Product\Modifier;

use Magento\Catalog\Model\Locator\LocatorInterface;
use Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\AbstractModifier;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Pricing\PriceCurrencyInterface;
use Lillik\PriceDecimal\Model\ConfigInterface;
use Lillik\PriceDecimal\Model\PricePrecisionConfigTrait;

class Price extends AbstractModifier
{
    use PricePrecisionConfigTrait;

    public function __construct(
        private LocatorInterface $locator,
        private DataPersistorInterface $dataPersistor,
        private ConfigInterface $moduleConfig
    ) {
    }

    public function modifyData(array $data)
    {
        if (!$this->locator->getProduct()->getId() && $this->dataPersistor->get('catalog_product')) {
            return $this->resolvePersistentData($data);
        }
        $productId = $this->locator->getProduct()->getId();
        $productPrice =  $this->locator->getProduct()->getPrice();
        $data[$productId][self::DATA_SOURCE_DEFAULT]['price'] = $this->formatPrice($productPrice);
        return $data;
    }

    /**
     * @inheritDoc
     */
    public function modifyMeta(array $meta): array
    {
        return $meta;
    }

    /**
     * Format price to have only two decimals after delimiter
     *
     * @param mixed $value
     */
    protected function formatPrice($value): string
    {
        return $value !== null
            ? number_format((float)$value, $this->getPricePrecision(), '.', '') : '';
    }

    /**
     * Resolve data persistence
     */
    private function resolvePersistentData(array $data): array
    {
        $persistentData = (array)$this->dataPersistor->get('catalog_product');
        $this->dataPersistor->clear('catalog_product');
        $productId = $this->locator->getProduct()->getId();

        if (empty($data[$productId][self::DATA_SOURCE_DEFAULT])) {
            $data[$productId][self::DATA_SOURCE_DEFAULT] = [];
        }

        $data[$productId] = array_replace_recursive(
            $data[$productId][self::DATA_SOURCE_DEFAULT],
            $persistentData
        );

        return $data;
    }
}
