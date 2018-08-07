<?php

namespace VS\Battle\Unit\Ability\CommandGiverUnit;

use VS\Battle\{
    Segregation\SubordinateInterface, Unit\Command\CommandInterface
};

/**
 * Interface CommandGiverInterface
 * @package VS\Battle\Unit\Ability\CommandGiverUnit
 */
interface CommandGiverInterface
{
    /**
     * @param SubordinateInterface $subordinate
     * @param CommandInterface $command
     * @return mixed
     */
    public function give(SubordinateInterface $subordinate, CommandInterface $command);
}