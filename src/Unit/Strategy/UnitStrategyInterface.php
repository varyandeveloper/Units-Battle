<?php

namespace VS\Battle\Unit\Strategy;

use VS\Battle\{
    Army\ArmyInterface, Unit\UnitInterface
};

/**
 * Interface UnitStrategyInterface
 * @package VS\Battle\Unit\Strategy
 */
interface UnitStrategyInterface
{
    /**
     * @param ArmyInterface $army
     * @return UnitInterface
     */
    public function getDetectUnitFromArmy(ArmyInterface $army): UnitInterface;
}