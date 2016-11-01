<?php

namespace ProjxIO\Collections\Common;

interface MutableItemCollection extends ItemCollection, MutableValueCollection
{
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
