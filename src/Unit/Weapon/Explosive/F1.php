<?php

namespace VS\Battle\Unit\Weapon\Explosive;

use VS\Battle\GameObject\GameObjectInterface;
use VS\Battle\Unit\Weapon\AbstractExplosive;

/**
 * Class F1
 * @package VS\Battle\Unit\Weapon\Explosive
 */
class F1 extends AbstractExplosive
{
    /**
     * @var string
     */
    protected $name = 'F1';

    /**
     * @var int
     */
    protected const POWER_VALUE = 10;

    /**
     * @param GameObjectInterface $gameObject
     * @return float
     */
    public function getDamageBasedOnDistance(GameObjectInterface $gameObject): float
    {
        // TODO: Implement getDamageBasedOnDistance() method.
    }
}