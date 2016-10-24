<?php

namespace ProjxIO\Collections\Common;

interface SequentialKeyCollection
{
    /**
     * @param mixed[] $keys
     * @return int[]
     */
    public function offsetsOfKeys($keys);

    /**
     * @param int $offset
     * @return mixed
     */
    public function keyAtOffset($offset);

    /**
     * @param int[] $offsets
     * @return mixed[]
     */
    public function keysAtOffsets($offsets);
}