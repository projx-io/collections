<?php

namespace ProjxIO\Collections\Common;

interface MapFromOne
{
    /**
     * @param mixed $value
     * @return Entry
     */
    public function itemOfValue($value);

    /**
     * @param mixed $value
     * @return mixed
     */
    public function keyOfValue($value);
}
