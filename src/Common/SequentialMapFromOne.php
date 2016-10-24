<?php

namespace ProjxIO\Collections\Common;

interface SequentialMapFromOne extends MapFromOne, SequentialValueSet
{
    /**
     * @param mixed $value
     * @return SequentialEntry
     */
    public function itemOfValue($value);
}