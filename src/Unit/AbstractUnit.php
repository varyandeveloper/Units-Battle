<?php

namespace VS\Battle\Unit;

use VS\Battle\Army\ArmyInterface;
use VS\Battle\GameObject\AbstractGameObject;
use VS\Battle\Segregation\DestroyableInterface;
use VS\Battle\Segregation\IncrementableInterface;
use VS\Battle\Unit\Defence\{
    DefenceInterface, DefenceStorage, NoDefence
};
use VS\Battle\Unit\Strategy\{
    UnitStrategyInterface, FindUnitWithMostPower
};
use VS\Battle\Unit\Weapon\EmptyWeapon;
use VS\Battle\Unit\Weapon\WeaponInterface;
use VS\Battle\Unit\Weapon\WeaponStorage;

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
     * @var DefenceStorage
     */
    protected $defences;
    /**
     * @var WeaponStorage
     */
    protected $weapons;
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
        $this->initWeapons();
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
     * @return DefenceStorage
     */
    public function getDefences(): DefenceStorage
    {
        return $this->defences;
    }

    /**
     * @param DefenceStorage $storage
     */
    public function setDefences(DefenceStorage $storage): void
    {
        $this->defences = $storage;
    }

    /**
     * @param DefenceInterface $defence
     * @return UnitInterface
     */
    public function addDefence(DefenceInterface $defence): UnitInterface
    {
        $this->defences->attach($defence);
        return $this;
    }

    /**
     * @param DefenceInterface $defence
     */
    public function takeDefence(DefenceInterface $defence)
    {
        $this->defences->detach($defence);
    }

    /**
     * @param WeaponInterface $weapon
     * @return mixed
     */
    public function takeWeapon(WeaponInterface $weapon): void
    {
        $this->weapons->detach($weapon);
    }

    /**
     * @param WeaponInterface $weapon
     * @return UnitInterface
     */
    public function addWeapon(WeaponInterface $weapon): UnitInterface
    {
        $this->weapons->attach($weapon);
        return $this;
    }

    /**
     * @return WeaponStorage
     */
    public function getWeapons(): WeaponStorage
    {
        return $this->weapons;
    }

    /**
     * @param WeaponStorage $storage
     * @return UnitInterface
     */
    public function setWeapons(WeaponStorage $storage): UnitInterface
    {
        $this->weapons = $storage;
        return $this;
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
     * @param UnitInterface $attacker
     * @return DefenceInterface
     */
    public function findTheBestWayToProtect(UnitInterface $attacker): DefenceInterface
    {
        // check if unit attack will kill me and I have defences then check my arsenal and use my best defence
        if ($this->willAttackerKillMeWithoutDefence($attacker) && $this->doIHaveDefences()) {
            $defences = $this->getDefencesSimpleArray();
            usort($defences, function (DefenceInterface $current, DefenceInterface $next) use ($attacker) {
                return $next->getSaveValue() <=> $current->getSaveValue();
            });

            $currentDefence = $this->findMinCostlyDefence($defences, $attacker);
            if ($this->shouldDefenceBeTaken($currentDefence)) {
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
     * @param UnitInterface $defender
     * @return WeaponInterface
     */
    public function findTheBestWeaponToUseForAttack(UnitInterface $defender): WeaponInterface
    {
        $weapons = $this->getWeaponsSimpleArray();
        usort($weapons, function (WeaponInterface $current, WeaponInterface $next) {
            return $next->getPowerValue() <=> $current->getPowerValue();
        });

        $currentWeapon = $this->findMinCostlyWeapon($weapons);

        if ($this->shouldWeaponBeTaken($currentWeapon)) {
            $this->takeWeapon($currentWeapon);
        }

        return $currentWeapon;
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
     * @param UnitInterface $defender
     * @return float
     */
    public function attack(UnitInterface $defender): float
    {
        $defence = $defender->findTheBestWayToProtect($this);
        $weapon = $this->findTheBestWeaponToUseForAttack($defender);
        $defence->applyDefence($this, $defender);

        if ($defence instanceof IncrementableInterface) {
            $defence->increment();
        }

        $currentHealth = $defender->getHealth();
        $defender->setHealth($currentHealth - $this->getPower());

        if ($defender->isKilled()) {
            $defender->setKilled(true);
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
        $this->setHealth(0);
        $this->isKilled = $killed;
    }

    /**
     * @return void
     */
    protected function initDefences(): void
    {
        $this->defences = new DefenceStorage;
        foreach (UnitMapper::getUnitDefences(get_class($this)) as $defenceClass) {
            $this->addDefence(new $defenceClass);
        }
    }

    /**
     * @return void
     */
    protected function initWeapons(): void
    {
        $this->weapons = new WeaponStorage;
        foreach (UnitMapper::getUnitWeapons(get_class($this)) as $weaponClass) {
            $this->weapons->attach(new $weaponClass);
        }
    }

    /**
     * @param UnitInterface $unit
     * @return bool
     */
    protected function willAttackerKillMeWithoutDefence(UnitInterface $unit): bool
    {
        return $unit->getPower() >= $this->getHealth();
    }

    /**
     * @return bool
     */
    protected function doIHaveDefences(): bool
    {
        return $this->defences->count() > 0;
    }

    /**
     * @return DefenceInterface[]
     */
    protected function getDefencesSimpleArray(): array
    {
        return iterator_to_array($this->getDefences());
    }

    /**
     * @return array
     */
    protected function getWeaponsSimpleArray() :array
    {
        return iterator_to_array($this->weapons);
    }

    /**
     * Detect if defence used by defender unit (after last attack) is destroyed
     *
     * @param DefenceInterface $defence
     * @return bool
     */
    protected function shouldDefenceBeTaken(DefenceInterface $defence): bool
    {
        if ($defence instanceof DestroyableInterface) {
            return $defence->isDestroyed();
        }

        return false;
    }

    /**
     * @param DefenceInterface[] $defences
     * @param UnitInterface $attacker
     * @return DefenceInterface
     */
    protected function findMinCostlyDefence(array $defences, UnitInterface $attacker): DefenceInterface
    {
        foreach ($defences as $defence) {
            if ($defence->getSaveValue() >= $attacker->getPower()) {
                return $defence;
            }
        }

        return new NoDefence;
    }

    /**
     * @param UnitInterface $attacker
     * @return float
     */
    protected function getPowerHealthDifference(UnitInterface $attacker): float
    {
        return $attacker->getPower() - $this->getHealth();
    }

    /**
     * @param WeaponInterface $weapon
     * @return bool
     */
    protected function shouldWeaponBeTaken(WeaponInterface $weapon): bool
    {
        if ($weapon instanceof DestroyableInterface) {
            return $weapon->isDestroyed();
        }

        return false;
    }

    /**
     * @param array $weapons
     * @return WeaponInterface
     */
    protected function findMinCostlyWeapon(array $weapons): WeaponInterface
    {
        foreach ($weapons as $weapon) {

        }

        return new EmptyWeapon;
    }
}