<?php

namespace ProjxIO\Collections;

use ProjxIO\Collections\Common\MutableSequentialValueCollection;
use ProjxIO\Collections\Common\SequentialValueList;

class ArraySequentialValueList implements SequentialValueList, MutableSequentialValueCollection
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

    /**
     * @inheritDoc
     */
    public function insertValue($offset, $value)
    {
        array_splice($this->values, $offset, 0, [$value]);
        $this->values = array_values($this->values);
    }

    /**
     * @inheritDoc
     */
    public function pushValueFront($value)
    {
        array_unshift($this->values, $value);
    }

    /**
     * @inheritDoc
     */
    public function pushValueBack($value)
    {
        array_push($this->values, $value);
    }

    /**
     * @inheritDoc
     */
    public function removeAt($offset)
    {
        if ($offset !== false && array_key_exists($offset, $this->values)) {
            array_splice($this->values, $offset, 1);
            $this->values = array_values($this->values);
        }
    }

    /**
     * @inheritDoc
     */
    public function containsValue($value)
    {
        return array_search($value, $this->values, true) !== false;
    }
}
