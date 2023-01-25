<?php

declare(strict_types=1);

namespace Lillik\PriceDecimal\Model\Plugin;

use Magento\Sales\Model\Order;

class OrderPlugin extends PriceFormatPluginAbstract
{
    public function beforeFormatPricePrecision(
        Order $subject,
        int|float $price,
        int $precision,
        bool $addBrackets = false
    ): array {
        //is enabled
        if ($this->getConfig()->isEnable()) {
            //change the precision
            $precision = $this->getPricePrecision();
        }

        return [$price, $precision, $addBrackets];
    }
}
