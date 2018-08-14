<?php

namespace VS\Battle\Segregation;

use VS\Battle\GameObject\GameObjectInterface;
use VS\Battle\Unit\UnitInterface;

/**
 * Interface DamageRadiusInterface
 * @package VS\Battle\Segregation
 */
interface DamageRadiusInterface extends GameObjectInterface
{
    /**
     * @param UnitInterface $unit
     * @return bool
     */
    public function canDamageUnit(UnitInterface $unit): bool;

    /**
     * @param GameObjectInterface $gameObject
     * @return float
     */
    public function getDamageBasedOnDistance(GameObjectInterface $gameObject): float;
}