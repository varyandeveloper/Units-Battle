<?php

namespace VS\Battle\Unit\Ability\Command;

use VS\Battle\Unit\Command\CommandInterface;

/**
 * Class AbstractCommand
 * @package VS\Battle\Unit\Ability\Command
 */
abstract class AbstractCommand implements CommandInterface
{
    /**
     * @var string
     */
    protected $command;

    /**
     * AbstractCommand constructor.
     * @param string $command
     */
    public function __construct(string $command)
    {
       $this->set($command);
    }

    /**
     * @param string $command
     * @return mixed|void
     */
    public function set(string $command)
    {
        $this->command = $command;
    }

    /**
     * @return string
     */
    public function get(): string
    {
        return $this->command;
    }
}