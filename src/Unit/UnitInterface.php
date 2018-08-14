<?php

namespace VS\Battle\Unit;

use VS\Battle\{
    Army\ArmyInterface, GameObject\GameObjectInterface
};
use VS\Battle\Segregation\{
    KillableInterface, SubordinateInterface
};
use VS\Battle\Unit\{Defence\DefenceInterface,
    Defence\DefenceStorage,
    Strategy\UnitStrategyInterface,
    Weapon\WeaponInterface,
    Weapon\WeaponStorage};

/**
 * Interface UnitInterface
 * @package VS\Battle\Unit
 */
interface UnitInterface extends
    GameObjectInterface,
    KillableInterface,
    SubordinateInterface
{
    /**
     * @param WeaponInterface $weapon
     * @return mixed
     */
    public function takeWeapon(WeaponInterface $weapon);

    /**
     * @param WeaponInterface $weapon
     * @return mixed
     */
    public function addWeapon(WeaponInterface $weapon);

    /**
     * @return WeaponStorage
     */
    public function getWeapons(): WeaponStorage;

    /**
     * @param WeaponStorage $storage
     * @return mixed
     */
    public function setWeapons(WeaponStorage $storage);

    /**
     * @param DefenceInterface $defence
     * @return mixed
     */
    public function takeDefence(DefenceInterface $defence);

    /**
     * @param DefenceInterface $defence
     * @return mixed
     */
    public function addDefence(DefenceInterface $defence);

    /**
     * @return DefenceStorage
     */
    public function getDefences(): DefenceStorage;

    /**
     * @param DefenceStorage $storage
     * @return mixed
     */
    public function setDefences(DefenceStorage $storage);

    /**
     * @param UnitStrategyInterface $attack
     * @return mixed
     */
    public function setTargetFindStrategy(UnitStrategyInterface $attack);

    /**
     * @return UnitStrategyInterface
     */
    public function getTargetFindStrategy(): UnitStrategyInterface;

    /**
     * @param DefenceInterface $protect
     * @return mixed
     */
    public function setProtectStrategy(DefenceInterface $protect);

    /**
     * @return DefenceInterface
     */
    public function getProtectStrategy(): DefenceInterface;

    /**
     * @param UnitInterface $unit
     * @return mixed
     */
    public function attack(UnitInterface $unit);

    /**
     * @param float $power
     * @return mixed
     */
    public function setPower(float $power);

    /**
     * @return float
     */
    public function getPower(): float;

    /**
     * @param float $health
     * @return mixed
     */
    public function setHealth(float $health);

    /**
     * @return float
     */
    public function getHealth(): float;

    /**
     * @param ArmyInterface $army
     * @return UnitInterface
     */
    public function findTheNextTarget(ArmyInterface $army): UnitInterface;

    /**
     * @param UnitInterface $attacker
     * @return DefenceInterface
     */
    public function findTheBestWayToProtect(UnitInterface $attacker): DefenceInterface;

    /**
     * @param UnitInterface $attacker
     * @return WeaponInterface
     */
    public function findTheBestWeaponToUseForAttack(UnitInterface $attacker): WeaponInterface;
}