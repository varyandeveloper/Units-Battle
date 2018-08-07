<?php

namespace VS\Battle\Unit;

use VS\Battle\{
    Army\ArmyInterface, GameObject\GameObjectInterface
};
use VS\Battle\Segregation\{
    KillableInterface, SubordinateInterface
};
use VS\Battle\Unit\{
    Defence\DefenceInterface, Strategy\UnitStrategyInterface
};

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
     * @param DefenceInterface $defence
     * @return void
     */
    public function takeDefence(DefenceInterface $defence);

    /**
     * @param DefenceInterface $defence
     * @return void
     */
    public function addDefence(DefenceInterface $defence);

    /**
     * @return array
     */
    public function getDefences(): array;

    /**
     * @param DefenceInterface ...$defences
     * @return mixed
     */
    public function setDefences(DefenceInterface ...$defences);

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
     * @param UnitInterface $unit
     * @return DefenceInterface
     */
    public function findTheBestWayToProtect(UnitInterface $unit): DefenceInterface;
}