<?php

namespace VS\Battle\Unit\Ability\ChoseAttackerUnit;

use VS\Battle\{
    Army\ArmyInterface, Unit\UnitInterface
};

/**
 * Trait ChoseAttackerUnitTrait
 * @package VS\Battle\Unit\Ability\ChoseAttackerUnit
 */
trait ChoseAttackerUnitTrait
{
    /**
     * @param ArmyInterface $army
     * @return UnitInterface
     */
    public function getAttackerFromOurArmy(ArmyInterface $army): UnitInterface
    {

    }
}