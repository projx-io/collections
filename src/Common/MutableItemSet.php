<?php

namespace ProjxIO\Collections\Common;

interface MutableItemSet extends ItemSet, MutableItemCollection
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
}
