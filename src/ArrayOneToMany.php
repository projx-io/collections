<?php

namespace ProjxIO\Collections;

use ProjxIO\Collections\Common\Entry;
use ProjxIO\Collections\Common\OneToMany;

class ArrayOneToMany implements OneToMany
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
     * @var Entry[][]
     */
    private $keysItems = [];

    /**
     * @var Entry[]
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
            $this->keysItems[$keyOffset] = [];
        }

        if ($valueOffset === false) {
            $valueOffset = count($this->values);
            $this->values[$valueOffset] = $value;
            $this->valuesItem[$valueOffset] = [];
        }

        $item = new EntryItem($key, $value);

        $this->items[] = &$item;
        $this->keysItems[$keyOffset][] = &$item;
        $this->valuesItem[$valueOffset][] = &$item;
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
     * Start FromMany
     ******************************************************************************************************************/
    /**
     * @inheritDoc
     */
    public function offsetsOfKey($key)
    {
        return array_map(function ($item) {
            return array_search($item, $this->items, true);
        }, $this->itemsOfKey($key));
    }

    /**
     * @inheritDoc
     */
    public function offsetsOfKeys($keys)
    {
        return array_map([$this, 'offsetsOfKey'], $keys);
    }

    /**
     * @inheritDoc
     */
    public function valuesOfKey($key)
    {
        return array_map(function (Entry $item) {
            return $item->value();
        }, $this->itemsOfKey($key));
    }

    /**
     * @inheritDoc
     */
    public function valuesOfKeys($keys)
    {
        return array_map([$this, 'valuesOfKey'], $keys);
    }

    /**
     * @inheritDoc
     */
    public function itemsOfKey($key)
    {
        $keys = array_search($key, $this->keys, true);
        return $keys === false ? [] : $this->keysItems[$keys];
    }

    /**
     * @inheritDoc
     */
    public function itemsOfKeys($keys)
    {
        return array_map([$this, 'itemsOfKey'], $keys);
    }
    /*******************************************************************************************************************
     * End FromMany
     ******************************************************************************************************************/

    /*******************************************************************************************************************
     * End ToOne
     ******************************************************************************************************************/
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
    public function keyOfValue($value)
    {
        return $this->keyOfOffset($this->offsetOfValue($value));
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
        return $this->itemOfOffset($this->offsetOfValue($value));
    }

    /**
     * @inheritDoc
     */
    public function itemOfValues($values)
    {
        return array_map([$this, 'itemOfValue'], $values);
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
        $offset = $this->offsetOfValue($value);
        return $offset !== false && $this->itemOfOffset($offset)->key() === $key ? $offset : false;
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
