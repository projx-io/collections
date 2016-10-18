<?php

namespace ProjxIO\Collections;

use ArrayAccess;

interface Sequence extends Collection, ArrayAccess
{
    /**
     * @param integer $offset
     * @return mixed
     */
    public function at($offset);

    /**
     * @param mixed $value
     * @return Sequence
     */
    public function prepend($value);

    /**
     * @param mixed $values
     * @return Sequence
     */
    public function prependAll($values);

    /**
     * @param mixed $value
     * @return Sequence
     */
    public function append($value);

    /**
     * @param mixed $values
     * @return Sequence
     */
    public function appendAll($values);

    /**
     * @param $offsets
     * @return Set
     */
    public function select($offsets);

    /**
     * @param $value
     * @return integer
     */
    public function firstOffsetOf($value);

    /**
     * @param $value
     * @return integer
     */
    public function lastOffsetOf($value);

    /**
     * @param $value
     * @return Set
     */
    public function offsetsOf($value);
}
