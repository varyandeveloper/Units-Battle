<?php

namespace VS\Battle\Output;
use VS\Battle\Game\GameInterface;

/**
 * Interface OutputInterface
 * @package VS\Battle\Output
 */
interface OutputInterface
{
    /**
     * @param GameInterface $game
     * @return string
     */
    public function getOutput(GameInterface $game): string;
}