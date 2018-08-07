<?php

namespace VS\Battle\Unit\Type;

use VS\Battle\{
    Segregation\SubordinateInterface, Unit\AbstractUnit, Unit\UnitInterface
};

/**
 * Class Soldier
 * @package VS\Battle\Unit\Type
 */
class Soldier extends AbstractUnit
{
    /**
     * Tank constructor.
     * @param string $name
     * @param float $posX
     * @param float $posY
     * @param float|null $posZ
     */
    public function __construct(string $name, float $posX, float $posY, ?float $posZ = null)
    {
        parent::__construct(1, 2, $name, $posX, $posY, $posZ);
    }

    /**
     * @param UnitInterface|SubordinateInterface $orderGiverUnit
     * @return mixed|void
     */
    public function applyCommand(SubordinateInterface $orderGiverUnit)
    {
        // TODO: Implement applyCommand() method.
    }
}