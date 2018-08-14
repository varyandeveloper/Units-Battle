<?php

namespace VS\Battle\Unit\Weapon;

use VS\Battle\Unit\Type\HeavyInfantry;
use VS\Battle\Unit\Type\Soldier;
use VS\Battle\Unit\Type\Tank;
use VS\Battle\Unit\Weapon\Explosive\F1;

/**
 * Class WeaponMapper
 * @package VS\Battle\Unit\Weapon
 */
class WeaponMapper
{
    const WEAPONS_CANT_DAMAGE_UNIT = [
        Tank::class => [
            Fist::class => true,
            F1::class => true
        ],
        Soldier::class => [

        ],
        HeavyInfantry::class => [

        ]
    ];
    /**
     * @var array
     */
    protected static $weaponsCantDamageUnit = [];

    /**
     * @param array $weaponsCantDamageUnit
     */
    public static function setWeaponsCantDamageUnit(array $weaponsCantDamageUnit): void
    {
        self::$weaponsCantDamageUnit = $weaponsCantDamageUnit;
    }

    /**
     * @param string $uniClass
     * @param string $weaponClass
     * @return bool
     */
    public static function canWeaponDamageUnit(string $uniClass, string $weaponClass): bool
    {
        return
            isset(self::$weaponsCantDamageUnit[$uniClass][$weaponClass]) ||
            isset(self::WEAPONS_CANT_DAMAGE_UNIT[$uniClass][$weaponClass]);
    }

    /**
     * @param string $unitClass
     * @return bool
     */
    public static function unitExists(string $unitClass): bool
    {
        return isset(self::$weaponsCantDamageUnit[$unitClass]) || isset(self::WEAPONS_CANT_DAMAGE_UNIT[$unitClass]);
    }
}