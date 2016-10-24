<?php

namespace ProjxIO\Collections;

use ProjxIO\Collections\Common\SequentialValueList;

class ArraySequentialValueList implements SequentialValueList
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
            $offsets = array_merge($offsets, $this->offsetsOfValue($value));
        }

        return $offsets;
    }

    /**
     * @inheritDoc
     */
    public function offsetsOfValue($value)
    {
        $offsets = [];

        foreach ($this->values as $offset => $v) {
            if ($value === $v) {
                $offsets[] = $offset;
            }
        }

        return $offsets;
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
        $values = [];

        foreach ($offsets as $offset) {
            $values[] = $this->valueAtOffset($offset);
        }

        return $values;
    }
}
