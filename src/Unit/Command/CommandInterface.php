<?php

namespace VS\Battle\Unit\Command;

/**
 * Interface CommandInterface
 * @package VS\Battle\Unit\Command
 */
interface CommandInterface
{
    /**
     * @param string $command
     * @return mixed
     */
    public function set(string $command);

    /**
     * @return string
     */
    public function get(): string;
}