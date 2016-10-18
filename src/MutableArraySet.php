<?php

namespace ProjxIO\Collections;

use ArrayIterator;

class MutableArraySet implements MutableSet
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
        $this->addAll($values);
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
    public function add($value)
    {
        if (!$this->contains($value)) {
            $this->values[] = $value;
        }
    }

    /**
     * @inheritDoc
     */
    public function addAll($values)
    {
        foreach ($values as $value) {
            $this->add($value);
        }
    }

    /**
     * @inheritDoc
     */
    public function remove($value)
    {
        $index = array_search($value, $this->values, true);
        if ($index !== false) {
            unset($this->values[$index]);
        }
    }

    /**
     * @inheritDoc
     */
    public function removeAll($values)
    {
        foreach ($values as $value) {
            $this->remove($value);
        }
    }

    /**
     * @inheritDoc
     */
    public function plus($value)
    {
        $set = new ArraySet($this->values);
        $set->add($value);
        return $set;
    }

    /**
     * @inheritDoc
     */
    public function plusAll($values)
    {
        $set = new ArraySet($this->values);
        $set->addAll($values);
        return $set;
    }

    /**
     * @inheritDoc
     */
    public function minus($value)
    {
        $set = new ArraySet($this->values);
        $set->remove($value);
        return $set;
    }

    /**
     * @inheritDoc
     */
    public function minusAll($values)
    {
        $set = new ArraySet($this->values);
        $set->removeAll($values);
        return $set;
    }

    /**
     * @inheritDoc
     */
    public function intersect($values)
    {
        $set = [];

        foreach ($values as $value) {
            if ($this->contains($value)) {
                $set[] = $value;
            }
        }

        return new ArraySet($set);
    }

    /**
     * @inheritDoc
     */
    public function each(callable $callback)
    {
        foreach ($this->values as $value) {
            call_user_func($callback, $value);
        }

        return $this;
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
}