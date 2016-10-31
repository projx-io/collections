<?php

namespace ProjxIO\Collections;

use ArrayIterator;
use ProjxIO\Collections\Common\ArrayCollection;
use ProjxIO\Collections\Common\MutableValueList;
use ProjxIO\Collections\Common\Stream;
use Traversable;

class ArrayList implements MutableValueList, ArrayCollection
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
        $this->addValues($values);
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
    public function offsetsOfValue($value)
    {
        $offsets = [];
        foreach ($this->values as $offset => &$item) {
            if ($item === $value) {
                $offsets[] = $offset;
            }
        }
        return $offsets;
    }

    /**
     * @inheritDoc
     */
    public function offsetsOfValues($values)
    {
        return array_map([$this, 'offsetsOfValue'], $values);
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
        $this->removeOffsets($this->offsetsOfValue($value));
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
    public function addValue($value)
    {
        $this->values[] = $value;
    }

    /**
     * @inheritDoc
     */
    public function addValues($values)
    {
        array_map([$this, 'addValue'], $values);
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
}
