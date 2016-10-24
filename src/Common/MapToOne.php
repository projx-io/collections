<?php

namespace ProjxIO\Collections\Common;

interface MapToOne
{
    /**
     * @param mixed $key
     * @return Entry
     */
    public function itemOfKey($key);

    /**
     * @param mixed $key
     * @return V
     */
    public function valueOfKey($key);
}
