<?php

namespace ProjxIO\Collections;

interface Sequence
{
    /**
     * @param int $deep
     * @return array
     */
    public function toArray($deep = 0);

    /**
     * @param mixed $value
     * @return Sequence
     */
    public function offsetsOf($value);

    /**
     * @param $offsets
     * @return Sequence
     */
    public function valuesAt($offsets);

    /**
     * @param int $offset
     * @return mixed
     */
    public function valueAt($offset);

    /**
     * @param mixed $value
     */
    public function pushBack($value);

    /**
     * @param mixed $values
     */
    public function pushBackValues($values);

    /**
     * @return Sequence
     */
    public function unique();

    /**
     * @param callable|null $callback
     * @return Sequence
     */
    public function sort(callable $callback = null);

    /**
     * @param mixed $value
     * @return boolean
     */
    public function contains($value);

    /**
     * @param $values
     * @return Sequence
     */
    public function intersect($values);

    /**
     * @param $offsets
     */
    public function removeOffsets($offsets);

    /**
     * @return Sequence
     */
    public function withOffsets();

    /**
     * @param $values
     * @return SequentialMultiMap
     */
    public function combine($values);

    /**
     * @param callable $callback
     * @return Sequence
     */
    public function each(callable $callback);

    /**
     * @param callable $callback
     * @return Sequence
     */
    public function map(callable $callback);

    /**
     * @param callable $callback
     * @return Sequence
     */
    public function filter(callable $callback);
}
