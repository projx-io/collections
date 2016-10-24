<?php

namespace ProjxIO\Collections\Common;

interface MapToMany
{
    /**
     * @param mixed $key
     * @return Entry[]
     */
    public function itemsOfKey($key);

    /**
     * @param mixed $key
     * @return mixed[]
     */
    public function valuesOfKey($key);
}
