<?php

namespace VS\Battle\Unit\Defence;

use VS\Battle\{
    Unit\UnitInterface
};

/**
 * Interface DefenceInterface
 * @package VS\Battle\Unit\Protect
 */
interface DefenceInterface
{
    /**
     * @param UnitInterface $attacker
     * @param UnitInterface $defender
     */
    public function applyDefence(UnitInterface $attacker, UnitInterface $defender): void;

    /**
     * @return float
     */
    public function getSaveValue(): float;
}