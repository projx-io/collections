<?php

namespace ProjxIO\Collections;

use Countable;
use IteratorAggregate;

interface Collection extends Countable, IteratorAggregate
{
    /**
     * @param $value
     * @return boolean
     */
    public function contains($value);

    /**
     * @param $values
     * @return boolean
     */
    public function containsAll($values);

    /**
     * @param $values
     * @return boolean
     */
    public function containsAny($values);

    /**
     * @param $values
     * @return boolean
     */
    public function containsNone($values);

    /**
     * @param $values
     * @return Collection
     */
    public function intersect($values);

    /**
     * @param callable $callback
     * @return Collection
     */
    public function each(callable $callback);

    /**
     * @param callable $callback
     * @return Collection
     */
    public function map(callable $callback);

    /**
     * @param callable $callback
     * @return Collection
     */
    public function filter(callable $callback);

    /**
     * @param callable $callback
     * @return mixed
     */
    public function reduce(callable $callback);

    /**
     * @param mixed $initial
     * @param callable $callback
     * @return mixed
     */
    public function fold($initial, callable $callback);
}
