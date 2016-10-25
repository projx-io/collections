<?php

namespace ProjxIO\Collections;

use ProjxIO\Collections\Common\Entry;
use ProjxIO\Collections\Common\Item;
use ProjxIO\Collections\Common\SequentialItem;
use ProjxIO\Collections\Common\SequentialOneToOne;

class ArraySequentialOneToOne implements SequentialOneToOne
{
    /**
     * @var array
     */
    private $keys;

    /**
     * @var array
     */
    private $values;

    /**
     *
     * @param array $keys
     * @param array $values
     */
    public function __construct($keys = [], $values = [])
    {
        $this->keys = $keys;
        $this->values = $values;
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
        return array_map([$this, 'itemAtOffset'], $offsets);
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
    public function itemsOfValues($values)
    {
        return $this->itemsAtOffsets($this->offsetsOfValues($values));
    }

    /**
     * @inheritDoc
     */
    public function keyAtOffset($offset)
    {
        return $this->keys[$offset];
    }

    /**
     * @inheritDoc
     */
    public function keysAtOffsets($offsets)
    {
        return array_map([$this, 'keyAtOffset'], $offsets);
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
        $offset = $this->offsetOfKey($item->key());
        return $this->valueAtOffset($offset) === $item->value() ? $offset : false;
    }

    /**
     * @inheritDoc
     */
    public function offsetsOfItems($items)
    {
        return array_map([$this, 'offsetOfItem'], $items);
    }

    /**
     * @inheritDoc
     */
    public function offsetOfKey($key)
    {
        return array_search($key, $this->keys, true);
    }

    /**
     * @inheritDoc
     */
    public function offsetsOfKeys($keys)
    {
        return array_map([$this, 'offsetOfKey'], $keys);
    }

    /**
     * @inheritDoc
     */
    public function offsetsOfValues($values)
    {
        return array_map([$this, 'offsetOfValue'], $values);
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
    public function valuesOfKeys($keys)
    {
        return $this->valuesAtOffsets($this->offsetsOfKeys($keys));
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
    public function containsEntry($key, $value)
    {
        return $this->offsetOfItem(new Item($key, $value)) !== false;
    }
}
