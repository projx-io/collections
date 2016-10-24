<?php

namespace ProjxIO\Collections\Common;

interface MapFromMany
{
    /**
     * @param mixed $value
     * @return Entry[]
     */
    public function itemsOfValue($value);

    /**
     * @param mixed $value
     * @return mixed[]
     */
    public function keysOfValue($value);
}
