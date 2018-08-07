<?php

namespace VS\Battle\Army\Strategy\Order;

use VS\Battle\Unit\UnitInterface;

/**
 * Class OrderByPowerASC
 * @package VS\Battle\Army\Strategy\Order
 */
class OrderByPowerASC implements OrderInterface
{
    /**
     * @param array $army
     * @return array
     */
    public function applyOrder(array $army): array
    {
        usort($army, function(UnitInterface $current, UnitInterface $next) {
            return $current->getPower() <=> $next->getPower();
        });

        return $army;
    }
}