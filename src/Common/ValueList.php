<?php

namespace ProjxIO\Collections\Common;

interface ValueList extends ValueCollection
{
    /**
     * @param mixed $value
     * @return mixed[]
     */
    public function offsetsOfValue($value);

    /**
     * @param mixed[] $values
     * @return mixed[][]
     */
    public function offsetsOfValues($values);
}
