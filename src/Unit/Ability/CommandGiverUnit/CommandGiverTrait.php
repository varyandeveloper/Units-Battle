<?php

namespace VS\Battle\Unit\Ability\CommandGiverUnit;

use VS\Battle\{
    Segregation\SubordinateInterface, Unit\Command\CommandInterface
};

/**
 * Trait CommandGiverTrait
 * @package VS\Battle\Unit\Ability\CommandGiverUnit
 * @mixin CommandGiverInterface
 */
trait CommandGiverTrait
{
    /**
     * @param SubordinateInterface $subordinate
     * @param CommandInterface $command
     * @return mixed
     */
    public function give(SubordinateInterface $subordinate, CommandInterface $command)
    {
        $this->update($subordinate);
    }
}