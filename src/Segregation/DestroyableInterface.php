<?php

namespace VS\Battle\Segregation;

/**
 * Interface DestroyableInterface
 * @package VS\Battle\Segregation
 */
interface DestroyableInterface
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
    public function setMaxUsageCount(int $count);

    /**
     * @return bool
     */
    public function isDestroyed(): bool;
}