<?php

namespace ProjxIO\Collections\Common;

interface SequentialItemCollection extends Map
{
    /**
     * @param Entry[] $items
     * @return int[]
     */
    public function offsetsOfItems($items);

    /**
     * @param int $offset
     * @return SequentialEntry
     */
    public function itemAtOffset($offset);

    /**
     * @param int[] $offsets
     * @return SequentialEntry[]
     */
    public function itemsAtOffsets($offsets);

    /**
     * @param mixed[] $values
     * @return SequentialEntry[]
     */
    public function itemsOfValues($values);

    /**
     * @param mixed[] $keys
     * @return SequentialEntry[]
     */
    public function itemsOfKeys($keys);
}
