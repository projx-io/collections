<?php

namespace ProjxIO\Collections;

use ProjxIO\Collections\Common\Entry;
use ProjxIO\Collections\Common\SequentialItem;
use ProjxIO\Collections\Common\SequentialOneToMany;
use ProjxIO\Collections\Common\SequentialValueList;
use ProjxIO\Collections\Common\SequentialValueSet;

class ArraySequentialOneToMany implements SequentialOneToMany
{
    /**
     * @var SequentialValueList
     */
    private $keys;

    /**
     * @var SequentialValueSet
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
        $this->values = new ArraySequentialValueSet($values);
    }

    /**
     * @inheritDoc
     */
    public function itemOfValue($value)
    {
        return $this->itemAtOffset($this->offsetOfValue($value));
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
    public function keyOfValue($value)
    {
        return $this->keyAtOffset($this->offsetOfValue($value));
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
        $offset = $this->offsetOfValue($item->value());
        return $this->keyAtOffset($offset) === $item->key() ? $offset : null;
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
    public function offsetOfValue($value)
    {
        return $this->values->offsetOfValue($value);
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
    public function itemsOfKey($key)
    {
        return $this->itemsAtOffsets($this->offsetsOfValues([$key]));
    }

    /**
     * @inheritDoc
     */
    public function valuesOfKey($key)
    {
        return $this->valuesAtOffsets($this->offsetsOfKey($key));
    }

    /**
     * @inheritDoc
     */
    public function offsetsOfKey($key)
    {
        return $this->keys->offsetsOfValue($key);
    }
}