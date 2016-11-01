<?php

namespace ProjxIO\Collections\Common;

interface ValueList extends ValueCollection
{
    /**
     * @param mixed $value
     * @return int[]
     */
    public function offsetsOfValue($value);

    /**
     * @param mixed[] $values
     * @return int[][]
     */
    public function offsetsOfValues($values);
}
