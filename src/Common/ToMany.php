<?php

namespace ProjxIO\Collections\Common;

interface ToMany extends FromToMany
{
    /**
     * @param mixed $key
     * @return mixed[]
     */
    public function offsetsOfKey($key);

    /**
     * @param mixed[] $keys
     * @return mixed[][]
     */
    public function offsetsOfKeys($keys);

    /**
     * @param mixed $key
     * @return mixed[]
     */
    public function valuesOfKey($key);

    /**
     * @param mixed[] $keys
     * @return mixed[][]
     */
    public function valuesOfKeys($keys);

    /**
     * @param mixed $key
     * @return Entry[]
     */
    public function itemsOfKey($key);

    /**
     * @param mixed[] $keys
     * @return Entry[][]
     */
    public function itemsOfKeys($keys);
}
