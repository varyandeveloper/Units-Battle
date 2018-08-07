<?php

namespace VS\Battle\Segregation;

/**
 * Interface SubordinateInterface
 * @package VS\Battle\Segregation
 */
interface SubordinateInterface
{
    /**
     * @param SubordinateInterface $orderGiverUnit
     * @return mixed
     */
    public function applyCommand(SubordinateInterface $orderGiverUnit);
}