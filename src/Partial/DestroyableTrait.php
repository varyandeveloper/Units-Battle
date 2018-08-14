<?php

namespace VS\Battle\Partial;

/**
 * Trait DestroyableTrait
 * @package VS\Battle\Partial
 */
trait DestroyableTrait
{
    /**
     * @var int|null
     */
    protected $usedCount = 0;
    /**
     * @var int|null
     */
    protected $maxUsageCount = 1;

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
    public function setMaxUsageCount(int $count)
    {
        $this->maxUsageCount = $count;
    }

    /**
     * @return bool
     */
    public function isDestroyable(): bool
    {
        return true;
    }
}