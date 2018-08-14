<?php

namespace VS\Battle\Output;

use VS\Battle\Game\GameInterface;

/**
 * Class SimpleOutput
 * @package VS\Battle\Output
 */
class SimpleOutput implements OutputInterface
{
    /**
     * @param GameInterface $game
     * @return string
     */
    public function getOutput(GameInterface $game): string
    {
        $winnerMessage = sprintf('The %s win the battle', $game->getWinnerArmy()->getName()) . PHP_EOL . PHP_EOL;

        $killedUnites   = "\tKilled unites:" . PHP_EOL;
        $killedUnites  .= "\t\t--------------------" . PHP_EOL;
        $liveUnites     = "\tLive unites:" . PHP_EOL;
        $liveUnites    .= "\t\t--------------------" . PHP_EOL;

        /**
         * @var \VS\Battle\Unit\UnitInterface $unit
         */
        foreach ($game->getWinnerArmy() as $unit) {
            if ($unit->isKilled()) {
                $killedUnites .= "\t\tName: " . $unit->getName() . PHP_EOL;
                $killedUnites .= "\t\tHealth: " . $unit->getHealth() . PHP_EOL;
                $killedUnites .= "\t\t--------------------" . PHP_EOL;
            } else {
                $liveUnites .= "\t\tName: " . $unit->getName() . PHP_EOL;
                $liveUnites .= "\t\tHealth: " . $unit->getHealth() . PHP_EOL;
                $liveUnites .= "\t\t--------------------" . PHP_EOL;
            }
        }

        return $winnerMessage . $liveUnites . $killedUnites;
    }
}