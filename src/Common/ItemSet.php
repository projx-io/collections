<?php

namespace ProjxIO\Collections\Common;

interface ItemSet extends ItemCollection
{
    /**
     * @param mixed $key
     * @param mixed $value
     * @return int
     */
    public function offsetOfEntry($key, $value);

    /**
     * @param Entry $item
     * @return int
     */
    public function offsetOfItem($item);

    /**
     * @param Entry[] $items
     * @return int[]
     */
    public function offsetOfItems($items);
}
