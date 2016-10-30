<?php

namespace ProjxIO\Collections;

use ProjxIO\Collections\Common\Entry;
use ProjxIO\Collections\Common\OneToOne;

class ArrayOneToOne implements OneToOne
{
    /**
     * @var array
     */
    private $keys = [];

    /**
     * @var array
     */
    private $values = [];

    /**
     * @var Entry[]
     */
    private $items = [];

    /**
     * @var Entry[]
     */
    private $keysItem = [];

    /**
     * @var Entry[][]
     */
    private $valuesItem = [];

    /**
     *
     * @param Entry[] $items
     */
    public function __construct($items = [])
    {
        $this->addItems($items);
    }

    /**
     * @param $offset
     */
    public function removeOffset($offset)
    {

    }

    /**
     * @param Entry $item
     */
    public function addItem(Entry $item)
    {
        $this->addEntry($item->key(), $item->value());
    }

    /**
     * @param mixed $key
     * @param mixed $value
     */
    public function addEntry($key, $value)
    {
        $keyOffset = array_search($key, $this->keys, true);
        $valueOffset = array_search($value, $this->values, true);

        if ($keyOffset === false) {
            $keyOffset = count($this->keys);
            $this->keys[$keyOffset] = $key;
        }

        if ($valueOffset === false) {
            $valueOffset = count($this->values);
            $this->values[$valueOffset] = $value;
        }

        $item = new EntryItem($key, $value);

        $this->items[] = &$item;
        $this->keysItem[$keyOffset] = &$item;
        $this->valuesItem[$valueOffset] = &$item;
    }

    /**
     * @param Entry[] $items
     */
    public function addItems($items)
    {
        array_map([$this, 'addItem'], $items);
    }
    /*******************************************************************************************************************
     * Start ToFromOneMany
     ******************************************************************************************************************/
    /**
     * @inheritDoc
     */
    public function keys()
    {
        return $this->keys;
    }

    /**
     * @inheritDoc
     */
    public function values()
    {
        return $this->values;
    }

    /**
     * @inheritDoc
     */
    public function items()
    {
        return $this->items;
    }

    /**
     * @inheritDoc
     */
    public function containsValue($value)
    {
        return $this->offsetOfValue($value) !== false;
    }

    /**
     * @inheritDoc
     */
    public function containsKey($key)
    {
        return $this->offsetOfKey($key) !== false;
    }

    /**
     * @inheritDoc
     */
    public function containsEntry($key, $value)
    {
        return $this->offsetOfEntry($key, $value) !== false;
    }

    /**
     * @inheritDoc
     */
    public function valueOfOffset($offset)
    {
        return $this->itemOfOffset($offset)->value();
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
    public function keyOfOffset($offset)
    {
        return $this->itemOfOffset($offset)->key();
    }

    /**
     * @inheritDoc
     */
    public function keyOfOffsets($offsets)
    {
        return array_map([$this, 'keyOfOffset'], $offsets);
    }

    /**
     * @inheritDoc
     */
    public function itemOfOffset($offset)
    {
        return $this->items[$offset];
    }

    /**
     * @inheritDoc
     */
    public function itemOfOffsets($offsets)
    {
        return array_map([$this, 'itemOfOffset'], $offsets);
    }
    /*******************************************************************************************************************
     * End ToFromOneMany
     ******************************************************************************************************************/

    /*******************************************************************************************************************
     * Start FromOne
     ******************************************************************************************************************/
    /**
     * @inheritDoc
     */
    public function offsetOfValue($value)
    {
        $valueOffset = array_search($value, $this->values, true);
        if ($valueOffset === false) {
            return false;
        }
        return array_search($this->valuesItem[$valueOffset], $this->items, true);
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
    public function keyOfValue($value)
    {
        return $this->itemOfValue($value)->key();
    }

    /**
     * @inheritDoc
     */
    public function keyOfValues($values)
    {
        return array_map([$this, 'keyOfValue'], $values);
    }

    /**
     * @inheritDoc
     */
    public function itemOfValue($value)
    {
        $values = array_search($value, $this->values, true);
        return $values === false ? null : $this->valuesItem[$values];
    }

    /**
     * @inheritDoc
     */
    public function itemOfValues($values)
    {
        return array_map([$this, 'itemOfValue'], $values);
    }
    /*******************************************************************************************************************
     * End FromOne
     ******************************************************************************************************************/

    /*******************************************************************************************************************
     * End ToOne
     ******************************************************************************************************************/
    /**
     * @inheritDoc
     */
    public function offsetOfKey($key)
    {
        $keyOffset = array_search($key, $this->keys, true);
        if ($keyOffset === false) {
            return false;
        }
        return array_search($this->keysItem[$keyOffset], $this->items, true);
    }

    /**
     * @inheritDoc
     */
    public function offsetOfKeys($keys)
    {
        return array_map([$this, 'offsetOfKey'], $keys);
    }

    /**
     * @inheritDoc
     */
    public function valueOfKey($key)
    {
        return $this->valueOfOffset($this->offsetOfKey($key));
    }

    /**
     * @inheritDoc
     */
    public function valueOfKeys($keys)
    {
        return array_map([$this, 'valueOfKey'], $keys);
    }

    /**
     * @inheritDoc
     */
    public function itemOfKey($key)
    {
        return $this->itemOfOffset($this->offsetOfKey($key));
    }

    /**
     * @inheritDoc
     */
    public function itemOfKeys($keys)
    {
        return array_map([$this, 'itemOfKey'], $keys);
    }
    /*******************************************************************************************************************
     * End ToOne
     ******************************************************************************************************************/

    /*******************************************************************************************************************
     * End FromToOne
     ******************************************************************************************************************/
    /**
     * @inheritDoc
     */
    public function offsetOfItem($item)
    {
        return $this->offsetOfEntry($item->key(), $item->value());
    }

    /**
     * @inheritDoc
     */
    public function offsetOfEntry($key, $value)
    {
        $offset = $this->offsetOfKey($key);
        return $offset !== false && $this->valueOfOffset($offset) === $value ? $offset : false;
    }

    /**
     * @inheritDoc
     */
    public function offsetOfItems($items)
    {
        return array_map([$this, 'offsetOfItem'], $items);
    }
    /*******************************************************************************************************************
     * End FromToOne
     ******************************************************************************************************************/
}
