<?php

namespace ProjxIO\Collections;

use ProjxIO\Collections\Common\Entry;
use ProjxIO\Collections\Common\SequentialItem;
use ProjxIO\Collections\Common\SequentialManyToMany;
use ProjxIO\Collections\Common\SequentialValueList;

class ArraySequentialManyToMany implements SequentialManyToMany
{
    /**
     * @var SequentialValueList
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
        $this->keys = new ArraySequentialValueList($keys);
        $this->values = new ArraySequentialValueList($values);
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
    public function offsetsOfItems($items)
    {
        return count($items) ? call_user_func_array('array_merge', array_map([$this, 'offsetsOfItem'], $items)) : [];
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
        return $this->itemsAtOffsets($this->offsetsOfValue($value));
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
    public function offsetsOfValue($value)
    {
        return $this->values->offsetsOfValue($value);
    }

    /**
     * @inheritDoc
     */
    public function itemsOfKey($key)
    {
        return $this->itemsAtOffsets($this->offsetsOfKey($key));
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
    public function offsetsOfItem(Entry $item)
    {
        return array_intersect($this->offsetsOfKey($item->key()), $this->offsetsOfValue($item->value()));
    }

    /**
     * @inheritDoc
     */
    public function offsetsOfKey($key)
    {
        return $this->keys->offsetsOfValue($key);
    }
}
