<?php

namespace ProjxIO\Collections;

use ProjxIO\Collections\Common\Entry;
use ProjxIO\Collections\Common\FromManyToOne;

class ArrayManyToOne implements FromManyToOne
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
    private $valuesItems = [];

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
            $this->keysItem[$keyOffset] = [];
        }

        if ($valueOffset === false) {
            $valueOffset = count($this->values);
            $this->values[$valueOffset] = $value;
            $this->valuesItems[$valueOffset] = [];
        }

        $item = new EntryItem($key, $value);

        $this->items[] = &$item;
        $this->keysItem[$keyOffset][] = &$item;
        $this->valuesItems[$valueOffset][] = &$item;
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
    public function offsetsOfValue($value)
    {
        return array_map(function ($item) {
            return array_search($item, $this->items, true);
        }, $this->itemsOfValue($value));
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
    public function keysOfValue($value)
    {
        return array_map(function (Entry $item) {
            return $item->key();
        }, $this->itemsOfValue($value));
    }

    /**
     * @inheritDoc
     */
    public function keysOfValues($values)
    {
        return array_map([$this, 'keysOfValue'], $values);
    }

    /**
     * @inheritDoc
     */
    public function itemsOfValue($value)
    {
        $values = array_search($value, $this->values, true);
        return $values === false ? [] : $this->valuesItems[$values];
    }

    /**
     * @inheritDoc
     */
    public function itemsOfValues($values)
    {
        return array_map([$this, 'itemsOfValue'], $values);
    }
    /*******************************************************************************************************************
     * End FromMany
     ******************************************************************************************************************/

    /*******************************************************************************************************************
     * Start ToFromMany
     ******************************************************************************************************************/
    /**
     * @inheritDoc
     */
    public function offsetsOfItem(Entry $item)
    {
        return $this->offsetsOfEntry($item->key(), $item->value());
    }

    /**
     * @inheritDoc
     */
    public function offsetsOfEntry($key, $value)
    {
        $keys = array_search($key, $this->keys, true);
        $values = array_search($value, $this->values, true);
        $keys = $keys === false ? [] : $this->keysItem[$keys];
        $values = $values === false ? [] : $this->valuesItems[$values];

        $items = array_values(array_filter($keys, function ($item) use ($values) {
            return array_search($item, $values, true) !== false;
        }));

        return array_map(function ($item) {
            return array_search($item, $this->items, true);
        }, $items);
    }

    /**
     * @inheritDoc
     */
    public function offsetsOfItems($items)
    {
        return array_map([$this, 'offsetsOfItem'], $items);
    }
    /*******************************************************************************************************************
     * End ToFromMany
     ******************************************************************************************************************/

    /*******************************************************************************************************************
     * End ToOne
     ******************************************************************************************************************/
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
    }

    /**
     * @inheritDoc
     */
    public function offsetOfEntry($key, $value)
    {

    }

    /**
     * @inheritDoc
     */
    public function offsetOfItems($items)
    {

    }
    /*******************************************************************************************************************
     * End FromToOne
     ******************************************************************************************************************/
}