<?php

namespace ProjxIO\Collections\Common;

interface MutableValueSet extends ValueSet, MutableValueCollection
{
    /**
     * @param mixed $value
     */
    public function putValue($value);

    /**
     * @param mixed[] $values
     */
    public function putValues($values);
}
