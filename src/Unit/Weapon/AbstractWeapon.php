<?php

namespace VS\Battle\Unit\Weapon;

/**
 * Class AbstractWeapon
 * @package VS\Battle\Unit\Weapon
 */
abstract class AbstractWeapon implements WeaponInterface
{
    /**
     * @var float
     */
    protected $powerValue = 1;

    /**
     * @return float
     */
    public function getPowerValue(): float
    {
        return $this->powerValue;
    }
}