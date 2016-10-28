<?php

namespace ProjxIO\Collections\Common;

interface FromToMany extends FromToOneMany
{
    /**
     * @param Entry $item
     * @return int[]
     */
    public function offsetsOfItem($item);

    /**
     * @param mixed $key
     * @param mixed $value
     * @return int[]
     */
    public function offsetsOfEntry($key, $value);

    /**
     * @param Entry[] $items
     * @return int[][]
     */
    public function offsetsOfItems($items);
}