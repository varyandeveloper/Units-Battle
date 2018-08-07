<?php

namespace VS\Battle\Unit\Defence;

use VS\Battle\Unit\UnitInterface;

/**
 * Class ShieldDefense
 * @package VS\Battle\Unit\Protect
 */
class ShieldDefense extends AbstractDefence implements DefenceInterface
{
    /**
     * @var int
     */
    protected $defenceValue = 2;

    /**
     * @param UnitInterface $attacker
     * @param UnitInterface $defender
     */
    public function applyDefence(UnitInterface $attacker, UnitInterface $defender): void
    {
        $defender->setHealth($defender->getHealth() + $this->defenceValue);
    }
}