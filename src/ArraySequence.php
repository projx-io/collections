<?php

namespace ProjxIO\Collections;

use ArrayIterator;
use Countable;
use IteratorAggregate;

class ArraySequence implements Sequence, IteratorAggregate, Countable
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
        foreach ($values as $value) {
            $this->values[] = $value;
        }
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
    public function getIterator()
    {
        return new ArrayIterator($this->values);
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        return $this->values;
    }

    /**
     * @inheritDoc
     */
    public function offsetsOf($value)
    {
        $offsets = new ArraySequence();

        foreach ($this->values as $offset => $item) {
            if ($item === $value) {
                $offsets->pushBack($offset);
            }
        }

        return $offsets;
    }

    /**
     * @inheritDoc
     */
    public function valuesAt($offsets)
    {
        $values = new ArraySequence();

        foreach ($offsets as $offset) {
            $values->pushBack($this->valueAt($offset));
        }

        return $values;
    }

    /**
     * @inheritDoc
     */
    public function valueAt($offset)
    {
        return $this->values[$offset];
    }

    /**
     * @inheritDoc
     */
    public function pushBack($value)
    {
        $this->values[] = $value;
    }

    /**
     * @inheritDoc
     */
    public function pushBackValues($values)
    {
        foreach ($values as $value) {
            $this->pushBack($value);
        }
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
    public function intersect($values)
    {
        $values = new ArraySequence($values);
        $intersection = new ArraySequence();

        foreach ($this->values as $value) {
            if ($values->contains($value)) {
                $intersection->pushBack($value);
            }
        }

        return $intersection;
    }

    /**
     * @inheritDoc
     */
    public function removeOffsets($offsets)
    {
        foreach ($offsets as $offset) {
            unset($this->values[$offset]);
        }
        $this->values = array_values($this->values);
    }

    /**
     * @inheritDoc
     */
    public function unique()
    {
        $values = new ArraySequence();

        foreach ($this as $value) {
            if (!$values->contains($value)) {
                $values->pushBack($value);
            }
        }

        return $values;
    }

    /**
     * @inheritDoc
     */
    public function sort(callable $callback = null)
    {
        $values = $this->values;
        if (is_null($callback)) {
            sort($values);
        } else {
            usort($values, $callback);
        }
        $values = array_values($values);
        return new ArraySequence($values);
    }

    /**
     * @inheritDoc
     */
    public function withOffsets()
    {
        return new ArraySequence(array_map(function ($value, $offset) {
            return new Pair($offset, $value, $offset);
        }, $this->values, range(0, $this->count() - 1)));
    }

    /**
     * @inheritDoc
     */
    public function combine($values)
    {
        if ($this->count() !== count($values)) {
            throw new CountMismatchException('Counts must match when combining sequences.');
        }

        return new SequentialMultiMap(new ArraySequence($this), new ArraySequence($values));
    }

    /**
     * @inheritDoc
     */
    public function map(callable $callback)
    {
        return new ArraySequence(array_map($callback, $this->values));
    }

    /**
     * @inheritDoc
     */
    public function filter(callable $callback)
    {
        return new ArraySequence(array_filter($this->values, $callback));
    }
}
