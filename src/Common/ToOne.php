<?php

namespace ProjxIO\Collections\Common;

interface ToOne extends FromToOne
{
    /**
     * @param mixed $key
     * @return mixed
     */
    public function offsetOfKey($key);

    /**
     * @param mixed[] $keys
     * @return mixed
     */
    public function offsetOfKeys($keys);

    /**
     * @param mixed $key
     * @return mixed
     */
    public function valueOfKey($key);

    /**
     * @param mixed[] $keys
     * @return mixed
     */
    public function valueOfKeys($keys);

    /**
     * @param mixed $key
     * @return Entry
     */
    public function itemOfKey($key);

    /**
     * @param mixed[] $keys
     * @return Entry[]
     */
    public function itemOfKeys($keys);
}
