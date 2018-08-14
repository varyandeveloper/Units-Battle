<?php

namespace VS\Battle\Game;

use VS\Battle\Army\ArmyInterface;
use VS\Battle\Output\OutputInterface;

/**
 * Interface GameInterface
 * @package VS\Battle\Game
 */
interface GameInterface
{
    /**
     * @return void
     */
    public function start();

    /**
     * @return bool
     */
    public function isOver(): bool;

    /**
     * @return ArmyInterface
     */
    public function getFirstArmy(): ArmyInterface;

    /**
     * @return ArmyInterface
     */
    public function getSecondArmy(): ArmyInterface;

    /**
     * @param ArmyInterface $army
     * @return void
     */
    public function setWinnerArmy(ArmyInterface $army);

    /**
     * @return ArmyInterface
     */
    public function getWinnerArmy(): ArmyInterface;

    /**
     * @param OutputInterface $output
     * @return mixed
     */
    public function showOutput(OutputInterface $output);
}