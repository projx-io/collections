<?php

namespace ProjxIO\Collections\Common;

interface SequentialValueSet extends SequentialValueCollection
{
    /**
     * @param mixed $value
     * @return int
     */
    public function offsetOfValue($value);
}
