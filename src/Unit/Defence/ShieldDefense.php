<?php

namespace VS\Battle\Unit\Defence;

use VS\Battle\Partial\DestroyableTrait;
use VS\Battle\Segregation\DestroyableInterface;
use VS\Battle\Segregation\IncrementableInterface;
use VS\Battle\Unit\UnitInterface;

/**
 * Class ShieldDefense
 * @package VS\Battle\Unit\Protect
 */
class ShieldDefense extends AbstractDefence implements DefenceInterface, DestroyableInterface, IncrementableInterface
{
    use DestroyableTrait;

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

    /**
     * @return bool
     */
    public function isDestroyed(): bool
    {
        return $this->getAlreadyUsedCount() === $this->getMaxUsageCount();
    }

    /**
     * @return void
     */
    public function increment(): void
    {
        $this->usedCount++;
    }
}