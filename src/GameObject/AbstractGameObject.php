<?php

namespace VS\Battle\GameObject;

/**
 * Class AbstractGameObject
 * @package VS\Battle\GameObject
 */
abstract class AbstractGameObject implements GameObjectInterface
{
    /**
     * @var string
     */
    protected $name;
    /**
     * @var float
     */
    protected $posX;
    /**
     * @var float
     */
    protected $posY;
    /**
     * @var float
     */
    protected $posZ = 0.0;

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

    /**
     * @return float
     */
    public function getPosX(): float
    {
        return $this->posX;
    }

    /**
     * @param float $posX
     */
    public function setPosX(float $posX): void
    {
        $this->posX = $posX;
    }

    /**
     * @return float
     */
    public function getPosY(): float
    {
        return $this->posY;
    }

    /**
     * @param float $posY
     */
    public function setPosY(float $posY): void
    {
        $this->posY = $posY;
    }

    /**
     * @return float
     */
    public function getPosZ(): float
    {
        return $this->posZ;
    }

    /**
     * @param float $posZ
     */
    public function setPosZ(float $posZ): void
    {
        $this->posZ = $posZ;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }
}