<?php

namespace ProjxIO\Collections\Common;

interface MutableValueList extends ValueList, MutableValueCollection
{
    /**
     * @param mixed $value
     */
    public function addValue($value);

    /**
     * @param mixed[] $values
     */
    public function addValues($values);
}
