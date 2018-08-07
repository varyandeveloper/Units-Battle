<?php

namespace VS\Battle\Unit\Defence;

use VS\Battle\Unit\UnitInterface;

/**
 * Class NoDefence
 * @package VS\Battle\Unit\Protect
 */
class NoDefence extends AbstractDefence implements DefenceInterface
{
    /**
     * @param UnitInterface $attacker
     * @param UnitInterface $defender
     */
    public function applyDefence(UnitInterface $attacker, UnitInterface $defender): void
    {

    }
}