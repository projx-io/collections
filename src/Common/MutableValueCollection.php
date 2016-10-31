<?php

namespace ProjxIO\Collections\Common;

interface MutableValueCollection extends ValueCollection
{
    /**
     * @param int $offset
     */
    public function removeOffset($offset);

    /**
     * @param int[] $offsets
     */
    public function removeOffsets($offsets);

    /**
     * @param mixed $value
     */
    public function removeValue($value);

    /**
     * @param mixed[] $values
     */
    public function removeValues($values);
}
