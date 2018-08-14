<?php

namespace VS\Battle\Partial;

use VS\Battle\Segregation\SubordinateInterface;

/**
 * Trait ObserverTrait
 * @package VS\Battle\Partial
 */
trait ObserverTrait
{
    /**
     * @var SubordinateInterface[]
     */
    protected $subordinates = [];

    /**
     * @param SubordinateInterface $observer
     * @return $this
     */
    public function attach (SubordinateInterface $observer)
    {
        $this->subordinates[spl_object_hash($observer)] = $observer;
        return $this;
    }

    public function detach (SubordinateInterface $observer)
    {

    }

    public function notify ()
    {

    }
}