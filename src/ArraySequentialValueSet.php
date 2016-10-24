<?php

namespace ProjxIO\Collections;

use ProjxIO\Collections\Common\SequentialValueSet;

class ArraySequentialValueSet implements SequentialValueSet
{
    /**
     * @var array
     */
    private $values;

    /**
     *
     * @param array $values
     */
    public function __construct($values = [])
    {
        $this->values = $values;
    }

    /**
     * @inheritDoc
     */
    public function offsetsOfValues($values)
    {
        $offsets = [];

        foreach ($values as $offset => $value) {
            $offset = $this->offsetOfValue($value);
            if ($offset !== false) {
                $offsets[] = $offset;
            }
        }

        return $offsets;
    }


    /**
     * @inheritDoc
     */
    public function offsetOfValue($value)
    {
        return array_search($value, $this->values, true);
    }

    /**
     * @inheritDoc
     */
    public function valueAtOffset($offset)
    {
        return $this->values[$offset];
    }

    /**
     * @inheritDoc
     */
    public function valuesAtOffsets($offsets)
    {
        return array_map([$this, 'valueAtOffset'], $offsets);
    }
}
