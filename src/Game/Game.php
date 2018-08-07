<?php

namespace VS\Battle\Game;

use VS\Battle\Unit\UnitMapper;
use VS\Battle\Army\{
    ArmyInterface, Army
};

/**
 * Class Game
 * @package VS\Battle\Game
 */
class Game implements GameInterface
{
    /**
     * @var $isFirstArmyAttacker
     */
    protected $isFirstArmyAttacker;
    /**
     * @var bool
     */
    protected $isOver = false;
    /**
     * @var ArmyInterface
     */
    protected $firstArmy;
    /**
     * @var ArmyInterface
     */
    protected $secondArmy;
    /**
     * @var ArmyInterface
     */
    protected $winnerArmy;

    /**
     * Game constructor.
     * @param array $firstArmy
     * @param array $secondArmy
     */
    public function __construct(array $firstArmy, array $secondArmy)
    {
        $this->initArmies($firstArmy, $secondArmy);
    }

    /**
     * @return void
     */
    public function start()
    {
        $this->isFirstArmyAttacker = (mt_rand(1,2) === 1);

        while (!$this->firstArmy->isKilled() && !$this->secondArmy->isKilled()) {
            $attacker = $this->getAttackerArmy()->current();
            $defender = $attacker->findTheNextTarget($this->getDefenderArmy());
            $attacker->attack($defender);

            if ($defender->isKilled()) {
                $this->getDefenderArmy()->increment();
            }

            $this->isFirstArmyAttacker = !$this->isFirstArmyAttacker;
        }

        $this->isOver = true;
        $this->setWinnerArmy($this->firstArmy->isKilled() ? $this->secondArmy : $this->firstArmy);
    }

    /**
     * @return bool
     */
    public function isOver(): bool
    {
        return $this->isOver;
    }

    /**
     * @param ArmyInterface $army
     */
    public function setWinnerArmy(ArmyInterface $army)
    {
        $this->winnerArmy = $army;
    }

    /**
     * @return ArmyInterface
     */
    public function getWinnerArmy(): ArmyInterface
    {
        return $this->winnerArmy;
    }

    /**
     * @return ArmyInterface
     */
    public function getFirstArmy(): ArmyInterface
    {
        return $this->firstArmy;
    }

    /**
     * @return ArmyInterface
     */
    public function getSecondArmy(): ArmyInterface
    {
        return $this->secondArmy;
    }

    /**
     * @return ArmyInterface
     */
    protected function getAttackerArmy(): ArmyInterface
    {
        return $this->isFirstArmyAttacker ? $this->firstArmy : $this->secondArmy;
    }

    /**
     * @return ArmyInterface
     */
    protected function getDefenderArmy(): ArmyInterface
    {
        return !$this->isFirstArmyAttacker ? $this->firstArmy : $this->secondArmy;
    }

    /**
     * @param array $firstArmy
     * @param array $secondArmy
     */
    protected function initArmies(array $firstArmy, array $secondArmy)
    {
        $armiesDistance = 10;
        $unitsFirstArray = [];
        $unitsSecondArray = [];

        foreach ($firstArmy as $i => $unitAlias) {
            $unitClass = UnitMapper::getUnitClassByAlias($unitAlias);
            $unitsFirstArray[] = new $unitClass(sprintf('ARMY1_%s%d', $unitAlias, $i+1), $i, 0);
        }

        foreach ($secondArmy as $i => $unitAlias) {
            $unitClass = UnitMapper::getUnitClassByAlias($unitAlias);
            $unitsSecondArray[] = new $unitClass(sprintf('ARMY2_%s%d', $unitAlias, $i+1), $i + $armiesDistance, 0);
        }

        $this->firstArmy = new Army('First Army', 0, 0, $unitsFirstArray);
        $this->secondArmy = new Army('Second Army', 0, 0, $unitsSecondArray);
    }
}