<?php

namespace VS\Battle\Unit\Weapon;

use VS\Battle\Unit\UnitInterface;

/**
 * Class AbstractWeapon
 * @package VS\Battle\Unit\Weapon
 */
abstract class AbstractWeapon implements WeaponInterface
{
    /**
     * @var float
     */
    protected const POWER_VALUE = 1;

    /**
     * @return float
     */
    public function getPowerValue(): float
    {
        return static::POWER_VALUE;
    }

    /**
     * @param UnitInterface $attacker
     * @param WeaponInterface $weapon
     * @return mixed|void
     */
    public function applyWeapon(UnitInterface $attacker, WeaponInterface $weapon)
    {
        // TODO: Implement applyWeapon() method.
    }
}