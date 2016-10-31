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
        return new ItemIterator($this->items);
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
        return new ItemStream(array_map($callback, $this->items));
    }

    /**
     * @inheritDoc
     */
    public function filter(callable $callback)
    {
        return new ItemStream(array_filter($this->items, $callback));
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
        return new ArrayOneToOne($this->items);
    }

    /**
     * @inheritDoc
     */
    public function toOneToMany()
    {
        return new ArrayOneToMany($this->items);
    }

    /**
     * @inheritDoc
     */
    public function toManyToOne()
    {
        return new ArrayManyToOne($this->items);
    }

    /**
     * @inheritDoc
     */
    public function toManyToMany()
    {
        return new ArrayManyToMany($this->items);
    }
}
