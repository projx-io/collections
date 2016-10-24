<?php

namespace ProjxIO\Collections\Common;

interface SequentialValueList extends SequentialValueCollection
{
    /**
     * @param mixed $value
     * @return int[]
     */
    public function offsetsOfValue($value);
}
