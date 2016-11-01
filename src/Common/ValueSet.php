<?php

namespace ProjxIO\Collections\Common;

interface ValueSet extends ValueCollection
{
    /**
     * @param mixed $value
     * @return int
     */
    public function offsetOfValue($value);

    /**
     * @param mixed[] $values
     * @return int[]
     */
    public function offsetOfValues($values);
}
