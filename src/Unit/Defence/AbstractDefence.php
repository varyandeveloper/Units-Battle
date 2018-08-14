<?php

namespace VS\Battle\Unit\Defence;

/**
 * Class AbstractDefence
 * @package VS\Battle\Unit\Protect
 */
abstract class AbstractDefence implements DefenceInterface
{
    /**
     * @var float
     */
    protected $defenceValue = 0;

    /**
     * @return float
     */
    public function getSaveValue(): float
    {
        return $this->defenceValue;
    }
}