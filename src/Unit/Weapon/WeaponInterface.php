<?php

namespace VS\Battle\Unit\Weapon;

use VS\Battle\Unit\UnitInterface;

/**
 * Interface WeaponInterface
 * @package VS\Battle\Unit\Weapon
 */
interface WeaponInterface
{
    /**
     * @return float
     */
    public function getPowerValue(): float;

    /**
     * @param UnitInterface $attacker
     * @param WeaponInterface $weapon
     * @return mixed
     */
    public function applyWeapon(UnitInterface $attacker, WeaponInterface $weapon);
}