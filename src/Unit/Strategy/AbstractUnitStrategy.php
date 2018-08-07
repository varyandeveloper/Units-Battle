<?php

namespace VS\Battle\Unit\Strategy;

use VS\Battle\Unit\UnitInterface;

/**
 * Class AbstractUnitStrategy
 * @package VS\Battle\Unit\Strategy
 */
abstract class AbstractUnitStrategy implements UnitStrategyInterface
{
    /**
     * @var UnitInterface
     */
    protected $unit;

    /**
     * AbstractNextUnitToAttack constructor.
     * @param UnitInterface $attacker
     */
    public function __construct(UnitInterface $attacker)
    {
        $this->unit = $attacker;
    }

    /**
     * @param array $army
     * @return array
     */
    protected function getOnlyLiveUnites(array $army): array
    {
        foreach ($army as $i => $unit) {
            if ($unit->isKilled()) {
                unset($army[$i]);
            }
        }

        return array_values($army);
    }
}