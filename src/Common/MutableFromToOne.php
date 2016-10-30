<?php

namespace ProjxIO\Collections\Common;

interface MutableFromToOne extends FromToOne
{
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
    public function removeItem($item);

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
