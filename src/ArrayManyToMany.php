<?php

namespace ProjxIO\Collections;

use ProjxIO\Collections\Common\Entry;
use ProjxIO\Collections\Common\EntryItem;
use ProjxIO\Collections\Common\FromManyToMany;

class ArrayManyToMany implements FromManyToMany
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
     * @var array
     */
    private $items = [];

    /**
     * @var array
     */
    private $keysItems = [];

    /**
     * @var array
     */
    private $valuesItems = [];

    /**
     *
     * @param array $items
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
            $this->valuesItems[$valueOffset] = [];
        }

        $item = new EntryItem($key, $value);

        $this->items[] = &$item;
        $this->keysItems[$keyOffset][] = &$item;
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

    }

    /**
     * @inheritDoc
     */
    public function valueOfOffsets($offsets)
    {

    }

    /**
     * @inheritDoc
     */
    public function keyOfOffset($offset)
    {

    }

    /**
     * @inheritDoc
     */
    public function keyOfOffsets($offsets)
    {

    }

    /**
     * @inheritDoc
     */
    public function itemOfOffset($offset)
    {

    }

    /**
     * @inheritDoc
     */
    public function itemOfOffsets($offsets)
    {

    }
    /*******************************************************************************************************************
     * End ToFromOneMany
     ******************************************************************************************************************/

    /*******************************************************************************************************************
     * Start ToMany
     ******************************************************************************************************************/
    /**
     * @inheritDoc
     */
    public function offsetsOfKey($key)
    {

    }

    /**
     * @inheritDoc
     */
    public function offsetsOfKeys($keys)
    {

    }

    /**
     * @inheritDoc
     */
    public function valuesOfKey($key)
    {

    }

    /**
     * @inheritDoc
     */
    public function valuesOfKeys($keys)
    {

    }

    /**
     * @inheritDoc
     */
    public function itemsOfKey($key)
    {

    }

    /**
     * @inheritDoc
     */
    public function itemsOfKeys($keys)
    {

    }
    /*******************************************************************************************************************
     * End ToMany
     ******************************************************************************************************************/

    /*******************************************************************************************************************
     * Start FromMany
     ******************************************************************************************************************/
    /**
     * @inheritDoc
     */
    public function offsetsOfValue($value)
    {

    }

    /**
     * @inheritDoc
     */
    public function offsetsOfValues($values)
    {

    }

    /**
     * @inheritDoc
     */
    public function keysOfValue($value)
    {

    }

    /**
     * @inheritDoc
     */
    public function keysOfValues($values)
    {

    }

    /**
     * @inheritDoc
     */
    public function itemsOfValue($value)
    {

    }

    /**
     * @inheritDoc
     */
    public function itemsOfValues($values)
    {

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
    public function offsetsOfItem($item)
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
        $keys = $keys === false ? [] : $this->keysItems[$keys];
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
}
