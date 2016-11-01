<?php

namespace ProjxIO\Collections;

use ArrayIterator;
use ProjxIO\Collections\Common\ArrayCollection;
use ProjxIO\Collections\Common\MutableValueSet;

class ArraySet implements MutableValueSet, ArrayCollection
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
        $this->putValues($values);
    }

    /**
     * @inheritDoc
     */
    public function containsValue($value)
    {
        return array_search($value, $this->values, true) !== false;
    }

    /**
     * @inheritDoc
     */
    public function valueOfOffset($offset)
    {
        return $this->values[$offset];
    }

    /**
     * @inheritDoc
     */
    public function valueOfOffsets($offsets)
    {
        return array_map([$this, 'valueOfOffset'], $offsets);
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        return $this->values;
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
    public function offsetOfValues($values)
    {
        return array_map([$this, 'offsetOfValue'], $values);
    }

    /**
     * @inheritDoc
     */
    public function removeOffset($offset)
    {
        unset($this->values[$offset]);
        $this->values = array_values($this->values);
    }

    /**
     * @inheritDoc
     */
    public function removeOffsets($offsets)
    {
        rsort($offsets);
        array_map([$this, 'removeOffset'], $offsets);
    }

    /**
     * @inheritDoc
     */
    public function removeValue($value)
    {
        $this->removeOffset($this->offsetOfValue($value));
    }

    /**
     * @inheritDoc
     */
    public function removeValues($values)
    {
        array_map([$this, 'removeValue'], $values);
    }

    /**
     * @inheritDoc
     */
    public function putValue($value)
    {
        $this->values[] = $value;
    }

    /**
     * @inheritDoc
     */
    public function putValues($values)
    {
        array_map([$this, 'putValue'], $values);
    }

    /**
     * @inheritDoc
     */
    public function getIterator()
    {
        return new ArrayIterator($this->values);
    }

    /**
     * @inheritDoc
     */
    public function stream()
    {
        return new ValueStream($this->values);
    }

    /**
     * @inheritDoc
     */
    public function count()
    {
        return count($this->values);
    }
}
