<?php

namespace ProjxIO\Collections;

use ArrayIterator;
use ProjxIO\Collections\Common\Entry;
use ProjxIO\Collections\Common\MutableItemSet;
use ProjxIO\Collections\Common\OneToMany;

class ArrayOneToMany implements OneToMany, MutableItemSet
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
        if ($this->containsValue($value)) {
            $this->removeValue($value);
        }

        $keyOffset = array_search($key, $this->keys, true);
        $valueOffset = count($this->values);

        if ($keyOffset === false) {
            $keyOffset = count($this->keys);
            $this->keysItems[$keyOffset] = [];
        }

        $item = new EntryItem($key, $value);

        $this->items[] = &$item;
        $this->keys[$keyOffset] = $key;
        $this->values[$valueOffset] = $value;
        $this->keysItems[$keyOffset][] = &$item;
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
        return count($this->offsetsOfKey($key)) > 0;
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

    /*******************************************************************************************************************
     * Start MutableFromToOne
     ******************************************************************************************************************/
    /**
     * @inheritDoc
     */
    public function putEntry($key, $value)
    {
        $this->addEntry($key, $value);
    }

    /**
     * @inheritDoc
     */
    public function putItem(Entry $item)
    {
        $this->putEntry($item->key(), $item->value());
    }

    /**
     * @inheritDoc
     */
    public function putItems($items)
    {
        array_map([$this, 'putItem'], $items);
    }

    /**
     * @param $offset
     */
    public function removeOffset($offset)
    {
        $this->removeItem($this->itemOfOffset($offset));
    }

    /**
     * @inheritDoc
     */
    public function removeOffsets($offsets)
    {
        $this->removeItems($this->itemOfOffsets($offsets));
    }

    /**
     * @param mixed $value
     */
    public function removeValue($value)
    {
        $this->removeItem($this->itemOfValue($value));
    }

    /**
     * @inheritDoc
     */
    public function removeValues($values)
    {
        array_map([$this, 'removeValue'], $values);
    }

    /**
     * @param mixed $key
     */
    public function removeKey($key)
    {
        $this->removeItems($this->itemsOfKey($key));
    }

    /**
     * @inheritDoc
     */
    public function removeKeys($keys)
    {
        array_map([$this, 'removeKey'], $keys);
    }

    /**
     * @inheritDoc
     */
    public function removeItem(Entry $item)
    {
        $this->removeEntry($item->key(), $item->value());
    }

    /**
     * @inheritDoc
     */
    public function removeItems($items)
    {
        array_map([$this, 'removeItem'], $items);
    }

    /**
     * @inheritDoc
     */
    public function removeEntry($key, $value)
    {
        if (!$this->containsEntry($key, $value)) {
            return;
        }

        $keyOffset = array_search($key, $this->keys, true);
        $valueOffset = array_search($value, $this->values, true);
        $item = $this->items[$valueOffset];
        $itemOffset = array_search($item, $this->items, true);
        $keyItemOffset = array_search($item, $this->keysItems, true);

        array_splice($this->values, $valueOffset, 1);
        array_splice($this->items, $itemOffset, 1);
        array_splice($this->keysItems[$keyOffset], $keyItemOffset, 1);

        if (empty($this->keysItems[$keyOffset])) {
            array_splice($this->keysItems, $keyOffset, 1);
            array_splice($this->keys, $keyOffset, 1);
        }
    }
    /*******************************************************************************************************************
     * End MutableFromToOne
     ******************************************************************************************************************/

    /**
     * @inheritDoc
     */
    public function withOffsets()
    {
        return array_map(function (Entry $item, $offset) {
            return new SequentialEntryItem($item->key(), $item->value(), $offset);
        }, $this->items, array_keys($this->items));
    }

    /**
     * @inheritDoc
     */
    public function getIterator()
    {
        return new ArrayIterator($this->items);
    }

    /**
     * @inheritDoc
     */
    public function stream()
    {
        return new ValueStream($this->items);
    }
}
