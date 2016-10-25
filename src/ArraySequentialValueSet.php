<?php

namespace ProjxIO\Collections;

use ProjxIO\Collections\Common\MutableSequentialValueCollection;
use ProjxIO\Collections\Common\SequentialValueSet;

class ArraySequentialValueSet implements SequentialValueSet, MutableSequentialValueCollection
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

    /**
     * @inheritDoc
     */
    public function insertValue($offset, $value)
    {
        $this->removeAt($this->offsetOfValue($value));
        array_splice($this->values, $offset, 0, [$value]);
        $this->values = array_values($this->values);
    }

    /**
     * @inheritDoc
     */
    public function pushValueFront($value)
    {
        $this->removeAt($this->offsetOfValue($value));
        array_unshift($this->values, $value);
    }

    /**
     * @inheritDoc
     */
    public function pushValueBack($value)
    {
        $this->removeAt($this->offsetOfValue($value));
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
}
