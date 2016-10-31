<?php

namespace ProjxIO\Collections\Common;

interface MutableItemSet extends ItemSet
{
    /**
     * @param mixed $key
     * @param mixed $value
     */
    public function putEntry($key, $value);

    /**
     * @param Entry $item
     */
    public function putItem(Entry $item);

    /**
     * @param Entry[] $items
     */
    public function putItems($items);

    /**
     * @param int $offset
     */
    public function removeOffset($offset);

    /**
     * @param int[] $offsets
     */
    public function removeOffsets($offsets);

    /**
     * @param mixed $value
     */
    public function removeValue($value);

    /**
     * @param mixed[] $values
     */
    public function removeValues($values);

    /**
     * @param mixed $key
     */
    public function removeKey($key);

    /**
     * @param mixed[] $keys
     */
    public function removeKeys($keys);

    /**
     * @param Entry $item
     */
    public function removeItem(Entry $item);

    /**
     * @param Entry[] $items
     */
    public function removeItems($items);

    /**
     * @param mixed $key
     * @param mixed $value
     */
    public function removeEntry($key, $value);
}
