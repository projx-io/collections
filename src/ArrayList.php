<?php

namespace ProjxIO\Collections;

use ProjxIO\Collections\Common\ArrayCollection;
use ProjxIO\Collections\Common\ValueList;

class ArrayList implements ValueList, ArrayCollection
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
        $this->values = array_values($values);
    }

    /**
     * @inheritDoc
     */
    public function containsValue($value)
    {
        return array_search($value, $this->values, true);
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
}
