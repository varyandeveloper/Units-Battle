<?php

namespace VS\Battle\Unit\Strategy;

use VS\Battle\Unit\UnitInterface;
use VS\Battle\Army\{
    ArmyInterface, Army
};

/**
 * Class FindClosestUnit
 * @package VS\Battle\Unit\Strategy
 */
class FindClosestUnit extends AbstractUnitStrategy
{
    /**
     * @param ArmyInterface $army
     * @return UnitInterface
     */
    public function getDetectUnitFromArmy(ArmyInterface $army): UnitInterface
    {
        $armyArray = $this->getOnlyLiveUnites($army->getArrayCopy());

        usort($armyArray, function(UnitInterface $current, UnitInterface $next) {
            return (abs($current->getPosX()) + abs($current->getPosY())) <=> (abs($next->getPosX()) + abs($next->getPosY()));
        });

        return (new Army($army->getName(), $army->getPosX(), $army->getPosY(), $armyArray))->first();
    }
}