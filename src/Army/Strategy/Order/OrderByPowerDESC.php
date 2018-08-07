<?php

namespace VS\Battle\Army\Strategy\Order;

use VS\Battle\Unit\UnitInterface;

/**
 * Class OrderByPowerDESC
 * @package VS\Battle\Army\Strategy\Order
 */
class OrderByPowerDESC implements OrderInterface
{
    /**
     * @param array $army
     * @return array
     */
    public function applyOrder(array $army): array
    {
        usort($army, function(UnitInterface $current, UnitInterface $next) {
            return $next->getPower() <=> $current->getPower();
        });

        return $army;
    }
}