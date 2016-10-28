<?php

namespace ProjxIO\Collections\Common;

interface FromMany extends FromToMany
{
    /**
     * @param mixed $value
     * @return mixed[]
     */
    public function offsetsOfValue($value);

    /**
     * @param mixed[] $values
     * @return mixed[][]
     */
    public function offsetsOfValues($values);

    /**
     * @param mixed $value
     * @return mixed[]
     */
    public function keysOfValue($value);

    /**
     * @param mixed[] $values
     * @return mixed[][]
     */
    public function keysOfValues($values);

    /**
     * @param mixed $value
     * @return Entry[]
     */
    public function itemsOfValue($value);

    /**
     * @param mixed[] $values
     * @return Entry[][]
     */
    public function itemsOfValues($values);
}