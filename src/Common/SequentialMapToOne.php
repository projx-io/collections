<?php

namespace ProjxIO\Collections\Common;

interface SequentialMapToOne extends MapToOne, SequentialKeySet
{
    /**
     * @param mixed $key
     * @return SequentialEntry
     */
    public function itemOfKey($key);
}