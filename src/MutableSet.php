<?php

namespace ProjxIO\Collections;

interface MutableSet extends Set
{
    /**
     * @param $value
     */
    public function add($value);

    /**
     * @param $values
     */
    public function addAll($values);

    /**
     * @param $value
     */
    public function remove($value);

    /**
     * @param $values
     */
    public function removeAll($values);
}
