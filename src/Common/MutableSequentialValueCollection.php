<?php

namespace ProjxIO\Collections\Common;

interface MutableSequentialValueCollection extends SequentialValueCollection
{
    /**
     * @param int $offset
     * @param mixed $value
     */
    public function insertValue($offset, $value);

    /**
     * @param mixed $value
     */
    public function pushValueFront($value);

    /**
     * @param mixed $value
     */
    public function pushValueBack($value);

    /**
     * @param int $offset
     */
    public function removeAt($offset);
}
