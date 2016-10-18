<?php

namespace ProjxIO\Collections;

use ArrayIterator;

class ArraySequence implements Sequence
{
    /**
     * @var array
     */
    private $values = [];

    /**
     *
     * @param array $values
     */
    public function __construct($values = [])
    {
        $this->values = array_values($values);
    }

    /**
     * @inheritDoc
     */
    public function getIterator()
    {
        return new ArrayIterator($this->values);
    }

    /**
     * @inheritDoc
     */
    public function count()
    {
        return count($this->values);
    }

    /**
     * @inheritDoc
     */
    public function offsetExists($offset)
    {
        return (int)$offset < $this->count();
    }

    /**
     * @inheritDoc
     */
    public function offsetGet($offset)
    {
        return $this->at((int)$offset);
    }

    /**
     * @inheritDoc
     */
    public function offsetSet($offset, $value)
    {
        throw new ImmutableException(__CLASS__ . ' is immutable.');
    }

    /**
     * @inheritDoc
     */
    public function offsetUnset($offset)
    {
        throw new ImmutableException(__CLASS__ . ' is immutable.');
    }

    /**
     * @inheritDoc
     */
    public function contains($value)
    {
        return array_search($value, $this->values, true) !== false;
    }

    /**
     * @inheritDoc
     */
    public function containsAll($values)
    {
        return $this->intersect($values)->count() === $this->count();
    }

    /**
     * @inheritDoc
     */
    public function containsAny($values)
    {
        return $this->intersect($values)->count() > 0;
    }

    /**
     * @inheritDoc
     */
    public function containsNone($values)
    {
        return $this->intersect($values)->count() === 0;
    }

    /**
     * @inheritDoc
     */
    public function at($offset)
    {
        return $this->values[$offset];
    }

    /**
     * @inheritDoc
     */
    public function intersect($values)
    {
        $set = new ArraySet($values);
        $array = [];

        foreach ($this->values as $value) {
            if ($set->contains($value)) {
                $array[] = $value;
            }
        }

        return new ArraySequence($array);
    }

    /**
     * @inheritDoc
     */
    public function each(callable $callback)
    {

    }

    /**
     * @inheritDoc
     */
    public function map(callable $callback)
    {

    }

    /**
     * @inheritDoc
     */
    public function filter(callable $callback)
    {

    }

    /**
     * @inheritDoc
     */
    public function reduce(callable $callback)
    {

    }

    /**
     * @inheritDoc
     */
    public function fold($initial, callable $callback)
    {

    }

    /**
     * @inheritDoc
     */
    public function prepend($value)
    {

    }

    /**
     * @inheritDoc
     */
    public function prependAll($values)
    {

    }

    /**
     * @inheritDoc
     */
    public function append($value)
    {

    }

    /**
     * @inheritDoc
     */
    public function appendAll($values)
    {

    }

    /**
     * @inheritDoc
     */
    public function select($offsets)
    {

    }

    /**
     * @inheritDoc
     */
    public function firstOffsetOf($value)
    {

    }

    /**
     * @inheritDoc
     */
    public function lastOffsetOf($value)
    {

    }

    /**
     * @inheritDoc
     */
    public function offsetsOf($value)
    {

    }
}
