<?php

namespace VS\Battle\Unit\Defence;

use VS\Battle\Unit\UnitInterface;

/**
 * Class EvasionDefence
 * @package VS\Battle\Unit\Protect
 */
class EvasionDefence extends AbstractDefence implements DefenceInterface
{
    /**
     * @var bool
     */
    protected $isDestroyable = false;
    /**
     * @var int
     */
    protected $maxUsageCount = 4;

    /**
     * @param UnitInterface $attacker
     * @param UnitInterface $defender
     */
    public function applyDefence(UnitInterface $attacker, UnitInterface $defender): void
    {
        $defender->setHealth($defender->getHealth() + $attacker->getPower());
    }
}