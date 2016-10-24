<?php

namespace ProjxIO\Collections;

use ProjxIO\Collections\Common\Entry;
use ProjxIO\Collections\Common\SequentialItem;
use ProjxIO\Collections\Common\SequentialManyToOne;
use ProjxIO\Collections\Common\SequentialValueList;
use ProjxIO\Collections\Common\SequentialValueSet;

class ArraySequentialManyToOne implements SequentialManyToOne
{
    /**
     * @var SequentialValueSet
     */
    private $keys;

    /**
     * @var SequentialValueList
     */
    private $values;

    /**
     *
     * @param array $keys
     * @param array $values
     */
    public function __construct($keys = [], $values = [])
    {
        $this->keys = new ArraySequentialValueSet($keys);
        $this->values = new ArraySequentialValueList($values);
    }

    /**
     * @inheritDoc
     */
    public function itemOfKey($key)
    {
        return $this->itemAtOffset($this->offsetOfKey($key));
    }

    /**
     * @inheritDoc
     */
    public function itemsOfKeys($keys)
    {
        return $this->itemsAtOffsets($this->offsetsOfKeys($keys));
    }

    /**
     * @inheritDoc
     */
    public function itemAtOffset($offset)
    {
        return new SequentialItem($this->keyAtOffset($offset), $this->valueAtOffset($offset), $offset);
    }

    /**
     * @inheritDoc
     */
    public function itemsAtOffsets($offsets)
    {
        $items = [];

        foreach ($offsets as $offset) {
            $items[] = $this->itemAtOffset($offset);
        }

        return $items;
    }

    /**
     * @inheritDoc
     */
    public function itemsOfValues($values)
    {
        return $this->itemsAtOffsets($this->offsetsOfValues($values));
    }

    /**
     * @inheritDoc
     */
    public function keyAtOffset($offset)
    {
        return $this->keys->valueAtOffset($offset);
    }

    /**
     * @inheritDoc
     */
    public function keysAtOffsets($offsets)
    {
        return $this->keys->valuesAtOffsets($offsets);
    }

    /**
     * @inheritDoc
     */
    public function keysOfValues($values)
    {
        return $this->keysAtOffsets($this->offsetsOfValues($values));
    }

    /**
     * @inheritDoc
     */
    public function offsetOfItem(Entry $item)
    {
        $offset = $this->offsetOfKey($item->key());
        return $this->valueAtOffset($offset) === $item->value() ? $offset : null;
    }

    /**
     * @inheritDoc
     */
    public function offsetsOfItems($items)
    {
        $offsets = [];

        foreach ($items as $item) {
            $offset = $this->offsetOfItem($item);
            if ($offset !== false) {
                $offsets[] = $offset;
            }
        }

        return $offsets;
    }

    /**
     * @inheritDoc
     */
    public function offsetOfKey($key)
    {
        return $this->keys->offsetOfValue($key);
    }

    /**
     * @inheritDoc
     */
    public function offsetsOfKeys($keys)
    {
        return $this->keys->offsetsOfValues($keys);
    }

    /**
     * @inheritDoc
     */
    public function offsetsOfValues($values)
    {
        return $this->values->offsetsOfValues($values);
    }

    /**
     * @inheritDoc
     */
    public function valuesOfKeys($keys)
    {
        return $this->valuesAtOffsets($this->offsetsOfKeys($keys));
    }

    /**
     * @inheritDoc
     */
    public function valueAtOffset($offset)
    {
        return $this->values->valueAtOffset($offset);
    }

    /**
     * @inheritDoc
     */
    public function valuesAtOffsets($offsets)
    {
        return $this->values->valuesAtOffsets($offsets);
    }

    /**
     * @inheritDoc
     */
    public function itemsOfValue($value)
    {
        return $this->itemsAtOffsets($this->offsetsOfKeys([$value]));
    }

    /**
     * @inheritDoc
     */
    public function keysOfValue($value)
    {
        return $this->keysAtOffsets($this->offsetsOfValue($value));
    }

    /**
     * @inheritDoc
     */
    public function valueOfKey($key)
    {
        return $this->valueAtOffset($this->offsetOfKey($key));
    }

    /**
     * @inheritDoc
     */
    public function offsetsOfValue($value)
    {
        return $this->values->offsetsOfValue($value);
    }
}
