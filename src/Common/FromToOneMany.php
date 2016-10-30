<?php

namespace ProjxIO\Collections\Common;

interface FromToOneMany
{
    /**
     * @return mixed[]
     */
    public function keys();

    /**
     * @return mixed[]
     */
    public function values();

    /**
     * @return Entry[]
     */
    public function items();

    /**
     * @param mixed $value
     * @return bool
     */
    public function containsValue($value);

    /**
     * @param mixed $key
     * @return bool
     */
    public function containsKey($key);

    /**
     * @param mixed $key
     * @param mixed $value
     * @return bool
     */
    public function containsEntry($key, $value);

    /**
     * @param Entry $item
     * @return bool
     */
    public function containsItem(Entry $item);

    /**
     * @param Entry[] $items
     * @return bool
     */
    public function containsItems($items);

    /**
     * @param int $offset
     * @return mixed
     */
    public function valueOfOffset($offset);

    /**
     * @param int[] $offsets
     * @return mixed[]
     */
    public function valueOfOffsets($offsets);

    /**
     * @param int $offset
     * @return mixed
     */
    public function keyOfOffset($offset);

    /**
     * @param int[] $offsets
     * @return mixed[]
     */
    public function keyOfOffsets($offsets);

    /**
     * @param int $offset
     * @return Entry
     */
    public function itemOfOffset($offset);

    /**
     * @param int[] $offsets
     * @return Entry[]
     */
    public function itemOfOffsets($offsets);
}
