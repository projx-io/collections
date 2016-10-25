<?php

namespace ProjxIO\Collections\Common;

interface MutableMap extends Map
{
    /**
     * @param $key
     * @param $value
     */
    public function put($key, $value);

    /**
     * @param $key
     * @param $value
     */
    public function remove($key, $value);
}
