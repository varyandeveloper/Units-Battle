<?php

require_once __DIR__ . "/vendor/autoload.php";

$game = new \VS\Battle\Game\Game(
    ['H', 'H', 'H', 'S'],
    ['T']
);

$game->start();
$game->showOutput();