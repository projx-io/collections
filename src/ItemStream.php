<?php

namespace ProjxIO\Collections;

use ProjxIO\Collections\Common\Entry;
use ProjxIO\Collections\Common\Stream;

class ItemStream implements Stream
{
    /**
     * @var Entry[]
     */
    private $items;

    /**
     *
     * @param Entry[] $items
     */
    public function __construct($items = [])
    {
        $this->items = $items;
    }

    /**
     * @inheritDoc
     */
    public function getIterator()
    {

    }

    /**
     * @inheritDoc
     */
    public function each(callable $callback)
    {
        array_map($callback, $this->items);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function map(callable $callback)
    {
        array_map($callback, $this->items);
        return $this;
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
    public function toSet()
    {
        return new ArraySet($this->items);
    }

    /**
     * @inheritDoc
     */
    public function toList()
    {
        return new ArrayList($this->items);
    }

    /**
     * @inheritDoc
     */
    public function toOneToOne()
    {

    }

    /**
     * @inheritDoc
     */
    public function toOneToMany()
    {

    }

    /**
     * @inheritDoc
     */
    public function toManyToOne()
    {

    }

    /**
     * @inheritDoc
     */
    public function toManyToMany()
    {

    }
}
