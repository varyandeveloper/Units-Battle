<?php

namespace VS\Battle\Segregation;

/**
 * Interface TimeableAttack
 * @package VS\Battle\Segregation
 */
interface TimeableAttack
{
    /**
     * @return float
     */
    public function getAttackTime(): float;

    /**
     * @param float $attackTime
     * @return mixed
     */
    public function setAttackTime(float $attackTime);
}