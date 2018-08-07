<?php

namespace VS\Battle\GameObject;

/**
 * Interface GameObjectInterface
 * @package VS\Battle\GameObject
 */
interface GameObjectInterface
{
    /**
     * @return float
     */
    public function getPosX(): float;

    /**
     * @return float
     */
    public function getPosY(): float;

    /**
     * @return float
     */
    public function getPosZ(): float;

    /**
     * @param float $pozX
     * @return mixed
     */
    public function setPosX(float $pozX);

    /**
     * @param float $pozY
     * @return mixed
     */
    public function setPosY(float $pozY);

    /**
     * @param float $pozZ
     * @return mixed
     */
    public function setPosZ(float $pozZ);

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param string $name
     * @return mixed
     */
    public function setName(string $name);
}