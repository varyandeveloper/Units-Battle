<?php

namespace VS\Battle\Unit\Defence;

use VS\Battle\{
    Segregation\IncrementableInterface, Unit\UnitInterface
};

/**
 * Interface DefenceInterface
 * @package VS\Battle\Unit\Protect
 */
interface DefenceInterface extends IncrementableInterface
{
    /**
     * @return int
     */
    public function getAlreadyUsedCount(): int;

    /**
     * @return int
     */
    public function getMaxUsageCount(): int;

    /**
     * @param int $count
     * @return void
     */
    public function setMaxUsageCount(int $count): void;

    /**
     * @return bool
     */
    public function isDestroyable(): bool;

    /**
     * @param UnitInterface $attacker
     * @param UnitInterface $defender
     */
    public function applyDefence(UnitInterface $attacker, UnitInterface $defender): void;

    /**
     * @param UnitInterface $attacker
     * @param UnitInterface $defender
     * @return float
     */
    public function getSavePercentage(UnitInterface $attacker, UnitInterface $defender): float;
}