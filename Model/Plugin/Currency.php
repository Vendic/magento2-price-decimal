<?php

declare(strict_types=1);

namespace Lillik\PriceDecimal\Model\Plugin;

use Lillik\PriceDecimal\Model\Currency as SubjectCurrency;

class Currency extends PriceFormatPluginAbstract
{
    public function beforeToCurrency(SubjectCurrency $subject, float|int $value = null, array $options = []): array
    {
        if ($this->getConfig()->isEnable()) {
            $options['precision'] = $subject->getPricePrecision();
        }
        return $options;
    }
}
