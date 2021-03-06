<?php

namespace ProjxIO\Collections;

use ArrayIterator;
use ProjxIO\Collections\Common\Entry;
use ProjxIO\Collections\Common\ManyToMany;

class ArrayManyToMany implements ManyToMany
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
     * @var Entry[][]
     */
    private $keysItems = [];

    /**
     * @var Entry[][]
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
        return count($this->offsetsOfValue($value)) > 0;
    }

    /**
     * @inheritDoc
     */
    public function containsKey($key)
    {
        return count($this->offsetsOfKey($key)) > 0;
    }

    /**
     * @inheritDoc
     */
    public function containsEntry($key, $value)
    {
        return count($this->offsetsOfEntry($key, $value)) > 0;
    }

    /**
     * @inheritDoc
     */
    public function containsItem(Entry $item)
    {
        return $this->containsEntry($item->key(), $item->value());
    }

    /**
     * @inheritDoc
     */
    public function containsItems($items)
    {
        foreach ($items as $item) {
            if (!$this->containsItem($item)) {
                return false;
            }
        }

        return true;
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
     * Start ToMany
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

    /**
     * @inheritDoc
     */
    public function getIterator()
    {
        return new ItemIterator($this->items);
    }

    /**
     * @inheritDoc
     */
    public function stream()
    {
        return new ValueStream($this->items);
    }

    /**
     * @inheritDoc
     */
    public function count()
    {
        return count($this->items);
    }
}
