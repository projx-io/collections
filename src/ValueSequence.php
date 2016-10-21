<?php

namespace ProjxIO\Collections;

interface ValueSequence
{
    /**
     * @param int $offset
     * @return mixed
     */
    public function valueAtOffset($offset);

    /**
     * @return mixed
     */
    public function firstValue();

    /**
     * @return mixed
     */
    public function lastValue();
}

interface MutableSequence
{
    /**
     * @param int $offset
     */
    public function removeOffset($offset);
}

interface MutableValueSequence
{
    /**
     * @param int $offset
     * @param mixed $value
     */
    public function setValueAtOffset($offset, $value);
}



interface SequentialSet
{
    public function offsetOf($value);
}

interface SequentialCollection
{
    public function offsetsOf($value);

    public function offsetOfFirst($value);

    public function offsetOfLast($value);
}
