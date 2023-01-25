<?php

declare(strict_types=1);

namespace Lillik\PriceDecimal\Block\System\Config\Form\Field;

use Magento\Framework\Option\ArrayInterface;

class Precision implements ArrayInterface
{
    public function toOptionArray(): array
    {
        return [
            ['value' => 1, 'label' => __('1')],
            ['value' => 2, 'label' => __('2')],
            ['value' => 3, 'label' => __('3')],
            ['value' => 4, 'label' => __('4')],
        ];
    }
}
