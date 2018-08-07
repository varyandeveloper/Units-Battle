<?php

namespace VS\Battle\Army;

use VS\Battle\Army\Strategy\Order\OrderInterface;
use VS\Battle\GameObject\GameObjectInterface;
use VS\Battle\Unit\UnitInterface;
use VS\Battle\Segregation\{
    IncrementableInterface, KillableInterface, SubordinateInterface
};

/**
 * Interface ArmyInterface
 * @package VS\Battle\Army
 * @method UnitInterface current()
 */
interface ArmyInterface extends GameObjectInterface,
    KillableInterface,
    \Iterator,
    \Countable,
    \ArrayAccess,
    SubordinateInterface,
    IncrementableInterface
{
    /**
     * @param OrderInterface $order
     * @return mixed
     */
    public function setOrderStrategy(OrderInterface $order);

    /**
     * @return OrderInterface
     */
    public function getOrderInterface(): OrderInterface;

    /**
     * @return UnitInterface
     */
    public function first(): UnitInterface;

    /**
     * @return UnitInterface[]
     */
    public function getArrayCopy(): array;
}