<?php

declare(strict_types=1);

namespace Lillik\PriceDecimal\Model\Plugin\Local;

use Lillik\PriceDecimal\Model\Plugin\PriceFormatPluginAbstract;
use Magento\Framework\Locale\FormatInterface;

class Format extends PriceFormatPluginAbstract
{
    public function afterGetPriceFormat(FormatInterface $subject, array $result): array
    {
        $precision = $this->getPricePrecision();

        if ($this->getConfig()->isEnable()) {
            $result['precision'] = $precision;
            $result['requiredPrecision'] = $precision;
        }

        return $result;
    }
}
