<?php

namespace ProjxIO\Collections\Common;

interface Map
{
    /**
     * @param mixed $key
     * @param mixed $value
     * @return bool
     */
    public function containsEntry($key, $value);

    /**
     * @param mixed[] $keys
     * @return mixed[]
     */
    public function valuesOfKeys($keys);

    /**
     * @param mixed[] $values
     * @return mixed[]
     */
    public function keysOfValues($values);

    /**
     * @param mixed[] $values
     * @return Entry[]
     */
    public function itemsOfValues($values);

    /**
     * @param mixed[] $keys
     * @return Entry[]
     */
    public function itemsOfKeys($keys);
}
