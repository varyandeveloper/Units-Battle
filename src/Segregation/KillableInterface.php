<?php

namespace VS\Battle\Segregation;

/**
 * Interface KillableInterface
 * @package VS\Battle\Segregation
 */
interface KillableInterface
{
    /**
     * @return bool
     */
    public function isKilled(): bool;

    /**
     * @param bool $killed
     * @return mixed
     */
    public function setKilled(bool $killed);
}