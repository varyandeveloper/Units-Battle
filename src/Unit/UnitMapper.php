<?php

namespace VS\Battle\Unit;

use VS\Battle\Unit\Defence\{
    EvasionDefence, ShieldDefense
};
use VS\Battle\Unit\Type\{
    HeavyInfantry, Soldier, Tank
};

/**
 * Class UnitMapper
 * @package VS\Battle\Unit
 */
class UnitMapper
{
    const SOLIDER_UNIT_ALIAS = 'S';
    const HEAVY_INFANTRY_ALIAS = 'H';
    const TANK_UNIT_ALIAS = 'T';

    const SOLIDER_UNIT_CLASS = Soldier::class;
    const HEAVY_INFANTRY_CLASS = HeavyInfantry::class;
    const TANK_UNIT_CLASS = Tank::class;

    const UNIT_MAP = [
        self::SOLIDER_UNIT_ALIAS => self::SOLIDER_UNIT_CLASS,
        self::HEAVY_INFANTRY_ALIAS => self::HEAVY_INFANTRY_CLASS,
        self::TANK_UNIT_ALIAS => self::TANK_UNIT_CLASS
    ];

    const UNIT_DEFENCES = [
        self::SOLIDER_UNIT_CLASS => [
            /*ShieldDefense::class,
            EvasionDefence::class,*/
        ],
        self::HEAVY_INFANTRY_CLASS => [
            /*ShieldDefense::class,*/
        ],
        self::TANK_UNIT_CLASS => [],
    ];

    const UNIT_WEAPONS = [
        self::SOLIDER_UNIT_CLASS => [

        ],
        self::HEAVY_INFANTRY_CLASS => [

        ],
        self::TANK_UNIT_CLASS => [

        ]
    ];

    /**
     * @var array
     */
    protected static $unites = [];
    /**
     * @var array
     */
    protected static $unitDefences = [];
    /**
     * @var array
     */
    protected static $unitWeapons = [];

    /**
     * @param string $alias
     * @return bool
     */
    public static function unitExists(string $alias): bool
    {
        return isset(self::$unites[$alias]) || isset(self::UNIT_MAP[$alias]);
    }

    /**
     * @param string $alias
     * @param string $class
     */
    public static function addUnit(string $alias, string $class)
    {
        if (strlen($alias) !== 1) {
            throw new \InvalidArgumentException('Unit alias should have exactly 1 character');
        }
        self::$unites[strtoupper($alias)] = $class;
    }

    /**
     * @param string $alias
     * @return string
     */
    public static function getUnitClassByAlias(string $alias): string
    {
        if (!self::unitExists($alias)) {
            throw new \InvalidArgumentException('Invalid unit alias ' . $alias);
        }

        $unit = self::$unites[$alias] ?? self::UNIT_MAP[$alias];

        if (!class_exists($unit)) {
            throw new \InvalidArgumentException('Unit ' . $unit . ' dose not exists');
        }

        return $unit;
    }

    /**
     * @param string $unitClass
     * @return bool
     */
    public static function unitHasDefences(string $unitClass): bool
    {
        return !empty(self::UNIT_DEFENCES[$unitClass] || !empty(self::$unitDefences[$unitClass]));
    }

    /**
     * @param string $unitClass
     * @return array
     */
    public static function getUnitDefences(string $unitClass): array
    {
        if (!self::unitHasDefences($unitClass)) {
            return [];
        }

        $array = self::UNIT_DEFENCES[$unitClass];

        if (!empty(self::$unitDefences[$unitClass])) {
            $array = array_merge($array, self::$unitDefences[$unitClass]);
        }

        return $array;
    }

    /**
     * @param array $unitDefences
     */
    public static function setUnitDefences(array $unitDefences): void
    {
        self::$unitDefences = $unitDefences;
    }

    /**
     * @param string $unitClass
     * @return array
     */
    public static function getUnitWeapons(string $unitClass): array
    {
        if (!self::unitHasDefences($unitClass)) {
            return [];
        }

        $array = self::UNIT_WEAPONS[$unitClass];

        if (!empty(self::$unitWeapons[$unitClass])) {
            $array = array_merge($array, self::$unitWeapons[$unitClass]);
        }

        return $array;
    }

    /**
     * @param array $unitWeapons
     */
    public static function setUnitWeapons(array $unitWeapons): void
    {
        self::$unitWeapons = $unitWeapons;
    }
}