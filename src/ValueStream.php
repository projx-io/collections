<?php

namespace ProjxIO\Collections;

use ProjxIO\Collections\Common\Stream;

class ValueStream implements Stream
{
    /**
     * @var mixed[]
     */
    private $values;

    /**
     *
     * @param mixed[] $values
     */
    public function __construct($values = [])
    {
        $this->values = $values;
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
        array_map($callback, $this->values);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function map(callable $callback)
    {
        array_map($callback, $this->values);
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
        return new ArraySet($this->values);
    }

    /**
     * @inheritDoc
     */
    public function toList()
    {
        return new ArrayList($this->values);
    }

    /**
     * @inheritDoc
     */
    public function toOneToOne()
    {
        return new ArrayOneToOne($this->values);
    }

    /**
     * @inheritDoc
     */
    public function toOneToMany()
    {
        return new ArrayOneToMany($this->values);
    }

    /**
     * @inheritDoc
     */
    public function toManyToOne()
    {
        return new ArrayManyToOne($this->values);
    }

    /**
     * @inheritDoc
     */
    public function toManyToMany()
    {
        return new ArrayManyToMany($this->values);
    }
}
