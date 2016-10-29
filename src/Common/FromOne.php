<?php

namespace ProjxIO\Collections\Common;

interface FromOne extends FromToOne
{
    /**
     * @param mixed $value
     * @return mixed
     */
    public function offsetOfValue($value);

    /**
     * @param mixed[] $values
     * @return mixed[]
     */
    public function offsetOfValues($values);

    /**
     * @param mixed $value
     * @return mixed
     */
    public function keyOfValue($value);

    /**
     * @param mixed[] $values
     * @return mixed[]
     */
    public function keyOfValues($values);

    /**
     * @param mixed $value
     * @return Entry
     */
    public function itemOfValue($value);

    /**
     * @param mixed[] $values
     * @return Entry[]
     */
    public function itemOfValues($values);
}
