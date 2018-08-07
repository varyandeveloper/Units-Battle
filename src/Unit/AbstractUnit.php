<?php

namespace VS\Battle\Unit;

use VS\Battle\Army\ArmyInterface;
use VS\Battle\GameObject\AbstractGameObject;
use VS\Battle\Unit\Defence\{
    DefenceInterface, NoDefence
};
use VS\Battle\Unit\Strategy\{
    UnitStrategyInterface, FindUnitWithMostPower
};

/**
 * Class AbstractUnit
 * @package VS\Battle\Unit
 */
abstract class AbstractUnit extends AbstractGameObject implements UnitInterface
{
    /**
     * @var float
     */
    protected $power;
    /**
     * @var float
     */
    protected $health;
    /**
     * @var array
     */
    protected $defences = [];
    /**
     * @var bool
     */
    protected $isKilled;
    /**
     * @var DefenceInterface
     */
    protected $protectStrategy;
    /**
     * @var UnitStrategyInterface
     */
    protected $nextUnitToAttackStrategy;

    /**
     * AbstractUnit constructor.
     * @param float $health
     * @param float $power
     * @param string $name
     * @param float $posX
     * @param float $posY
     * @param float|null $posZ
     */
    public function __construct(float $health, float $power, string $name, float $posX, float $posY, float $posZ = null)
    {
        parent::__construct($name, $posX, $posY, $posZ);
        $this->setPower($power);
        $this->setHealth($health);
        $this->setTargetFindStrategy(new FindUnitWithMostPower($this));
        $this->initDefences();
    }

    /**
     * @param UnitStrategyInterface $nextUnitToAttack
     * @return mixed|void
     */
    public function setTargetFindStrategy(UnitStrategyInterface $nextUnitToAttack)
    {
        $this->nextUnitToAttackStrategy = $nextUnitToAttack;
    }

    /**
     * @return UnitStrategyInterface
     */
    public function getTargetFindStrategy(): UnitStrategyInterface
    {
        return $this->nextUnitToAttackStrategy;
    }

    /**
     * @param DefenceInterface $protect
     * @return mixed|void
     */
    public function setProtectStrategy(DefenceInterface $protect)
    {
        $this->protectStrategy = $protect;
    }

    /**
     * @return DefenceInterface
     */
    public function getProtectStrategy(): DefenceInterface
    {
        return $this->protectStrategy;
    }

    /**
     * @return array
     */
    public function getDefences(): array
    {
        return $this->defences;
    }

    /**
     * @param DefenceInterface ...$defences
     * @return void
     */
    public function setDefences(DefenceInterface ...$defences): void
    {
        foreach ($defences as $defence) {
            $this->addDefence($defence);
        }
    }

    /**
     * @param DefenceInterface $defence
     */
    public function addDefence(DefenceInterface $defence)
    {
        $this->defences[spl_object_hash($defence)] = $defence;
    }

    /**
     * @param DefenceInterface $defence
     */
    public function takeDefence(DefenceInterface $defence)
    {
        unset($this->defences[spl_object_hash($defence)]);
    }

    /**
     * @param ArmyInterface $army
     * @return UnitInterface
     */
    public function findTheNextTarget(ArmyInterface $army): UnitInterface
    {
        return $this->nextUnitToAttackStrategy->getDetectUnitFromArmy($army);
    }

    /**
     * @param UnitInterface $unit
     * @return DefenceInterface
     */
    public function findTheBestWayToProtect(UnitInterface $unit): DefenceInterface
    {
        // check if unit attack will kill me and I have defences then check my arsenal and use my best defence
        if ($unit->getPower() > $this->getHealth() && !empty($this->getDefences())) {
            $defences = array_values($this->getDefences());
            usort($defences, function (DefenceInterface $current, DefenceInterface $next) use ($unit) {
                return $next->getSavePercentage($unit, $this) <=> $current->getSavePercentage($unit, $this);
            });

            /**
             * @var DefenceInterface $currentDefence
             */
            $currentDefence = $defences[0];
            if ($currentDefence->isDestroyable() || $currentDefence->getMaxUsageCount() === $currentDefence->getAlreadyUsedCount()) {
                $this->takeDefence($currentDefence);
            }
            $this->setProtectStrategy($currentDefence);
            return $currentDefence;
        }

        $defence = new NoDefence;
        $this->setProtectStrategy($defence);
        return $defence;
    }

    /**
     * @return float
     */
    public function getHealth(): float
    {
        return $this->health;
    }

    /**
     * @param float $health
     */
    public function setHealth(float $health): void
    {
        $this->health = $health;
    }

    /**
     * @return float
     */
    public function getPower(): float
    {
        return $this->power;
    }

    /**
     * @param float $power
     */
    public function setPower(float $power): void
    {
        $this->power = $power;
    }

    /**
     * @param UnitInterface $unit
     * @return float
     */
    public function attack(UnitInterface $unit): float
    {
        $defence = $unit->findTheBestWayToProtect($this);
        $defence->applyDefence($this, $unit);
        $defence->increment();
        $currentHealth = $unit->getHealth();
        $unit->setHealth($currentHealth - $this->getPower());

        if ($unit->getHealth() <= 0) {
            $unit->setKilled(true);
        }

        return $this->getPower() - $currentHealth;
    }

    /**
     * @return bool
     */
    public function isKilled(): bool
    {
        return ($this->isKilled || $this->getHealth() <= 0);
    }

    /**
     * @param bool $killed
     * @return void
     */
    public function setKilled(bool $killed): void
    {
        $this->isKilled = $killed;
    }

    /**
     * @return void
     */
    protected function initDefences(): void
    {
        foreach (UnitMapper::getUnitDefences(get_class($this)) as $defenceClass) {
            $this->addDefence(new $defenceClass);
        }
    }
}