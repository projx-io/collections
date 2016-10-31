<?php

namespace ProjxIO\Collections\Common;

interface ItemList extends ItemCollection
{
    /**
     * @param mixed $key
     * @param mixed $value
     * @return int[]
     */
    public function offsetsOfEntry($key, $value);

    /**
     * @param Entry $item
     * @return int[]
     */
    public function offsetsOfItem(Entry $item);

    /**
     * @param Entry[] $items
     * @return int[][]
     */
    public function offsetsOfItems($items);
}
