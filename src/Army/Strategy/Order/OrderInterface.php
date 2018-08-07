<?php

namespace VS\Battle\Army\Strategy\Order;

/**
 * Interface OrderInterface
 * @package VS\Battle\Army\Strategy\Order
 */
interface OrderInterface
{
    /**
     * @param array $army
     * @return array
     */
    public function applyOrder(array $army): array;
}