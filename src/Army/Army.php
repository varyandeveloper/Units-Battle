<?php

namespace VS\Battle\Army;

use VS\Battle\GameObject\AbstractGameObject;
use VS\Battle\Segregation\SubordinateInterface;
use VS\Battle\Unit\UnitInterface;
use VS\Battle\Army\Strategy\Order\{
    OrderByPowerDESC, OrderInterface
};

/**
 * Class Army
 * @package VS\Battle\Army
 */
class Army extends AbstractGameObject implements ArmyInterface
{
    /**
     * @var OrderInterface
     */
    protected $orderStrategy;
    /**
     * @var UnitInterface[]
     */
    protected $units = [];
    /**
     * @var int
     */
    protected $index = 0;
    /**
     * @var int
     */
    protected $killedUnitsCount = 0;

    /**
     * Army constructor.
     * @param string $name
     * @param float $posX
     * @param float $posY
     * @param array $array
     * @param float|null $posZ
     */
    public function __construct(string $name, float $posX, float $posY, array $array = [], ?float $posZ = null)
    {
        parent::__construct($name, $posX, $posY, $posZ);
        $this->setOrderStrategy(new OrderByPowerDESC);
        $this->units = $this->orderStrategy->applyOrder($array);
    }

    /**
     * @param OrderInterface $order
     * @return mixed|void
     */
    public function setOrderStrategy(OrderInterface $order)
    {
        $this->orderStrategy = $order;
    }

    /**
     * @return OrderInterface
     */
    public function getOrderInterface(): OrderInterface
    {
        return $this->orderStrategy;
    }

    /**
     * @return UnitInterface[]
     */
    public function getArrayCopy(): array
    {
        return $this->units;
    }

    /**
     * @return UnitInterface
     */
    public function first(): UnitInterface
    {
        $this->rewind();
        return $this->current();
    }

    /**
     * @return UnitInterface
     */
    public function current(): UnitInterface
    {
        return $this->units[$this->index];
    }

    /**
     * @return void
     */
    public function next(): void
    {
        $this->index++;
    }

    /**
     * @return mixed
     */
    public function key()
    {
        return $this->index;
    }

    /**
     * @return bool
     */
    public function valid(): bool
    {
        return $this->offsetExists($this->index);
    }

    /**
     * @return void
     */
    public function rewind(): void
    {
        $this->index = 0;
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->units);
    }

    /**
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset): bool
    {
        return isset($this->units[$this->index]);
    }

    /**
     * @param mixed $offset
     * @return mixed|UnitInterface
     */
    public function offsetGet($offset)
    {
        return $this->units[$offset];
    }

    /**
     * @param mixed $offset
     * @param UnitInterface $value
     */
    public function offsetSet($offset, $value)
    {
        if (!$value instanceof UnitInterface) {
            throw new \InvalidArgumentException('Value should be an instance of ' . UnitInterface::class);
        }
        $this->units[$offset] = $value;
    }

    /**
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        unset($this->units[$offset]);
    }

    /**
     * @return void
     */
    public function increment(): void
    {
        $this->killedUnitsCount++;
    }

    /**
     * @return bool
     */
    public function isKilled(): bool
    {
        return ($this->count() === 0 || $this->killedUnitsCount === $this->count());
    }

    /**
     * @param bool $killed
     * @return void
     */
    public function setKilled(bool $killed): void
    {
        $this->units = [];
    }

    /**
     * @param SubordinateInterface|ArmyInterface $orderGiverUnit
     * @return mixed|void
     */
    public function applyCommand(SubordinateInterface $orderGiverUnit)
    {
        // TODO: Implement applyCommand() method.
    }
}