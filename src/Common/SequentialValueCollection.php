<?php

namespace ProjxIO\Collections\Common;

interface SequentialValueCollection
{
    /**
     * @param mixed $value
     * @return bool
     */
    public function containsValue($value);

    /**
     * @param mixed[] $values
     * @return int[]
     */
    public function offsetsOfValues($values);

    /**
     * @param int $offset
     * @return mixed
     */
    public function valueAtOffset($offset);

    /**
     * @param int[] $offsets
     * @return mixed[]
     */
    public function valuesAtOffsets($offsets);
}
