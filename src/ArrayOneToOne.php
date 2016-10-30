<?php

namespace ProjxIO\Collections;

use ProjxIO\Collections\Common\Entry;
use ProjxIO\Collections\Common\MutableFromToOne;
use ProjxIO\Collections\Common\OneToOne;

class ArrayOneToOne implements OneToOne, MutableFromToOne
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
        if ($this->containsEntry($key, $value)) {
            return;
        }

        $this->removeKey($key);
        $this->removeValue($value);

        $offset = count($this->keys);

        $item = new EntryItem($key, $value);
        $this->keys[$offset] = $key;
        $this->values[$offset] = $value;
        $this->items[$offset] = &$item;
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

    /*******************************************************************************************************************
     * End MutableFromToOne
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

    }

    /**
     * @param $offset
     */
    public function removeOffset($offset)
    {
        if ($offset !== false) {
            array_splice($this->items, $offset, 1);
            array_splice($this->keys, $offset, 1);
            array_splice($this->values, $offset, 1);

            $this->items = array_values($this->items);
            $this->keys = array_values($this->keys);
            $this->values = array_values($this->values);
        }
    }

    /**
     * @inheritDoc
     */
    public function removeOffsets($offsets)
    {
        rsort($offsets);
        return array_map([$this, 'removeOffset'], $offsets);
    }

    /**
     * @param mixed $value
     */
    public function removeValue($value)
    {
        $this->removeOffset($this->offsetOfValue($value));
    }

    /**
     * @inheritDoc
     */
    public function removeValues($values)
    {
        return array_map([$this, 'removeValue'], $values);
    }

    /**
     * @param mixed $key
     */
    public function removeKey($key)
    {
        $this->removeOffset($this->offsetOfKey($key));
    }

    /**
     * @inheritDoc
     */
    public function removeKeys($keys)
    {
        return array_map([$this, 'removeKey'], $keys);
    }

    /**
     * @inheritDoc
     */
    public function removeItem(Entry $item)
    {
        return $this->removeEntry($item->key(), $item->value());
    }

    /**
     * @inheritDoc
     */
    public function removeItems($items)
    {
        return array_map([$this, 'removeItem'], $items);
    }

    /**
     * @inheritDoc
     */
    public function removeEntry($key, $value)
    {
        $this->removeOffset($this->offsetOfEntry($key, $value));
    }
    /*******************************************************************************************************************
     * End MutableFromToOne
     ******************************************************************************************************************/
}
