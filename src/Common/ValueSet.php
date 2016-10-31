<?php

namespace ProjxIO\Collections\Common;

interface ValueSet extends ValueCollection
{
    /**
     * @param mixed $value
     * @return mixed
     */
    public function offsetOfValue($value);

    /**
     * @param mixed[] $values
     * @return mixed[]
     */
    public function offsetOfValues($values);
}
