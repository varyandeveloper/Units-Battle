<?php

namespace VS\Battle\GameObject;

use VS\Battle\Partial\GameObjectCoordinatesTrait;

/**
 * Class AbstractGameObject
 * @package VS\Battle\GameObject
 */
abstract class AbstractGameObject implements GameObjectInterface
{
    use GameObjectCoordinatesTrait;

    /**
     * AbstractGameObject constructor.
     * @param string $name
     * @param float $posX
     * @param float $posY
     * @param float|null $posZ
     */
    public function __construct(string $name, float $posX, float $posY, ?float $posZ = null)
    {
        $this->setName($name);
        $this->setPosX($posX);
        $this->setPosY($posY);

        if (null !== $posZ) {
            $this->setPosZ($posZ);
        }
    }
}