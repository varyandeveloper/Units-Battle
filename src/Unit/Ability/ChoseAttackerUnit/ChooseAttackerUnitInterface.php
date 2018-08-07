<?php

namespace VS\Battle\Unit\Ability\ChoseAttackerUnit;

use VS\Battle\{
    Army\ArmyInterface, Unit\UnitInterface
};

/**
 * Interface ChooseAttackerUnitInterface
 * @package VS\Battle\Unit\Ability\ChoseBestAttackerUnit
 */
interface ChooseAttackerUnitInterface
{
    /**
     * @param ArmyInterface $army
     * @return UnitInterface
     */
    public function getAttackerFromOurArmy(ArmyInterface $army): UnitInterface;
}