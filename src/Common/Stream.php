<?php

namespace ProjxIO\Collections\Common;

use IteratorAggregate;

interface Stream extends IteratorAggregate
{
    /**
     * @param callable $callback
     * @return Stream
     */
    public function each(callable $callback);

    /**
     * @param callable $callback
     * @return Stream
     */
    public function map(callable $callback);

    /**
     * @param callable $callback
     * @return Stream
     */
    public function filter(callable $callback);

    /**
     * @return ValueSet
     */
    public function toSet();

    /**
     * @return ValueList
     */
    public function toList();

    /**
     * @return OneToOne
     */
    public function toOneToOne();

    /**
     * @return OneToMany
     */
    public function toOneToMany();

    /**
     * @return ManyToOne
     */
    public function toManyToOne();

    /**
     * @return ManyToMany
     */
    public function toManyToMany();
}