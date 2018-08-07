<?php

namespace VS\Battle\Unit\Defence;

use VS\Battle\Unit\UnitInterface;

/**
 * Class AbstractDefence
 * @package VS\Battle\Unit\Protect
 */
abstract class AbstractDefence implements DefenceInterface
{
    /**
     * @var int
     */
    protected $usedCount = 0;
    /**
     * @var int
     */
    protected $maxUsageCount = 1;
    /**
     * @var bool $isDestroyable
     */
    protected $isDestroyable = true;
    /**
     * @var float $defenceValue
     */
    protected $defenceValue = 0;

    /**
     * @param UnitInterface $attacker
     * @param UnitInterface $defender
     * @return float
     */
    public function getSavePercentage(UnitInterface $attacker, UnitInterface $defender): float
    {
        if ($attacker->getPower() <= 0) {
            return 0;
        }

        $value = 100 * (($defender->getHealth() + $this->defenceValue) / $attacker->getPower());

        if ($value > 100) {
            return 100;
        }

        return $value;
    }

    /**
     * @return bool
     */
    public function isDestroyable(): bool
    {
        return $this->isDestroyable;
    }

    /**
     * @return int
     */
    public function getAlreadyUsedCount(): int
    {
        return $this->usedCount;
    }

    /**
     * @return int
     */
    public function getMaxUsageCount(): int
    {
        return $this->maxUsageCount;
    }

    /**
     * @param int $count
     * @return void
     */
    public function setMaxUsageCount(int $count): void
    {
        $this->maxUsageCount = $count;
    }

    /**
     * @return void
     */
    public function increment(): void
    {
        $this->usedCount++;
    }
}