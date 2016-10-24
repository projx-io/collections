<?php

namespace ProjxIO\Collections\Common;

interface SequentialKeySet extends SequentialKeyCollection
{
    /**
     * @param mixed $key
     * @return int
     */
    public function offsetOfKey($key);
}
