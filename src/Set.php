<?php

namespace ProjxIO\Collections;

use Countable;

interface Set extends Collection
{
    /**
     * @param $value
     * @return Set
     */
    public function plus($value);

    /**
     * @param $values
     * @return Set
     */
    public function plusAll($values);

    /**
     * @param $value
     * @return Set
     */
    public function minus($value);

    /**
     * @param $values
     * @return Set
     */
    public function minusAll($values);
}
