<?php

namespace ProjxIO\Collections\Common;

interface SequentialKeyList extends SequentialKeyCollection
{
    /**
     * @param mixed $key
     * @return int[]
     */
    public function offsetsOfKey($key);
}
