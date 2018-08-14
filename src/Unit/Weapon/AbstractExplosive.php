<?php

namespace VS\Battle\Unit\Weapon;

use VS\Battle\GameObject\GameObjectInterface;
use VS\Battle\Partial\DestroyableTrait;
use VS\Battle\Partial\GameObjectCoordinatesTrait;
use VS\Battle\Segregation\DamageRadiusInterface;
use VS\Battle\Segregation\DestroyableInterface;
use VS\Battle\Unit\UnitInterface;

/**
 * Class AbstractExplosive
 * @package VS\Battle\Unit\Weapon
 */
abstract class AbstractExplosive extends AbstractWeapon implements
    GameObjectInterface,
    DamageRadiusInterface,
    DestroyableInterface
{
    use GameObjectCoordinatesTrait,
        DestroyableTrait;

    /**
     * @param UnitInterface $unit
     * @return bool
     */
    public function canDamageUnit(UnitInterface $unit): bool
    {
        return WeaponMapper::canWeaponDamageUnit(get_class($unit), get_class($this));
    }
}