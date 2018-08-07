<?php

require_once __DIR__ . "/vendor/autoload.php";

$game = new \VS\Battle\Game\Game(
    ['S', 'S', 'H'],
    ['H', 'H', 'H']
);

$game->start();

if ($game->isOver()) {
    echo sprintf('The %s win the battle', $game->getWinnerArmy()->getName()) . PHP_EOL . PHP_EOL;

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

    echo $liveUnites, $killedUnites;
}