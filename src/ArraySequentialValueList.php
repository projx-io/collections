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
        return count($values) ? call_user_func_array('array_merge', array_map([$this, 'offsetsOfValue'], $values)) : [];
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
        return array_map([$this, 'valueAtOffset'], $offsets);
    }
}
